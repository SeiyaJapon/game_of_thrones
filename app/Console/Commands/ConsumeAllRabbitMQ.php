<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ConsumeAllRabbitMQ extends Command
{
    protected $signature = 'rabbitmq:consume-all';
    protected $description = 'Start all RabbitMQ consumers in parallel (non-blocking)';

    protected array $activeProcesses = [];

    public function handle(): void
    {
        $this->info('Starting all RabbitMQ consumers...');

        $consumerCommands = [
            'rabbitmq:consume-actor-created',
            'rabbitmq:consume-actor-deleted',
            'rabbitmq:consume-actor-updated',
            'rabbitmq:consume-character-created',
            'rabbitmq:consume-character-deleted',
            'rabbitmq:consume-character-updated',
        ];

        $projectRoot = base_path();

        foreach ($consumerCommands as $commandName) {
            $commandToExecute = ['php', '-dopcache.enable=0', 'artisan', $commandName];
            $process = new Process($commandToExecute, $projectRoot);

            $process->start();
            $this->activeProcesses[] = $process;

            $this->info("➤ Launched: " . $commandName . " (PID: " . $process->getPid() . ")");
        }

        $this->info('All consumers launched. Keeping main process alive...');
        $this->warn('Press Ctrl+C to stop all consumers.');

        while (true) {
            foreach ($this->activeProcesses as $key => $proc) {
                if (!$proc->isRunning()) {
                    $this->error("Process '{$proc->getCommandLine()}' (PID: {$proc->getPid()}) exited unexpectedly. Error output: {$proc->getErrorOutput()}");
                    unset($this->activeProcesses[$key]);
                }
            }

            if (empty($this->activeProcesses)) {
                $this->error("All consumer processes exited. Exiting master command.");
                break;
            }

            sleep(60);
        }

        $this->info('Main command finished.');
    }

    public function __destruct()
    {
        foreach ($this->activeProcesses as $process) {
            if ($process->isRunning()) {
                $this->info("Stopping child process: {$process->getCommandLine()} (PID: {$process->getPid()})");
                $process->stop(10);
            }
        }
//        $this->info('All child processes have been stopped.');
    }
}