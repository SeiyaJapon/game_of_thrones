<?php

namespace App\Console\Commands;

use App\HotelsContext\Domain\Common\Services\FieldMapper;
use App\HotelsContext\Domain\Common\Services\FileValidator;
use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use App\HotelsContext\Application\Hotel\Command\CreateHotelCommand;
use App\HotelsContext\Domain\Common\Services\FileParserContext;
use App\HotelsContext\Domain\Common\Services\CsvParser;
use App\HotelsContext\Domain\Common\Services\JsonParser;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportHotels extends Command
{
    protected $signature = 'app:import-hotels {file}';
    protected $description = 'Import hotels from a CSV or JSON file';

    private CommandBusInterface $commandBus;
    private FileValidator $fileValidator;
    private FileParserContext $fileParserContext;
    private FieldMapper $fieldMapper;

    public function __construct(
        CommandBusInterface $commandBus,
        FileValidator $fileValidator,
        FileParserContext $fileParserContext,
        FieldMapper $fieldMapper
    ) {
        parent::__construct();
        $this->commandBus = $commandBus;
        $this->fileValidator = $fileValidator;
        $this->fileParserContext = $fileParserContext;
        $this->fieldMapper = $fieldMapper;
    }

    public function handle(): void
    {
        $filePath = $this->argument('file');

        if (!$this->fileValidator->validate($filePath)) {
            $this->error("File does not exist or is not valid.");
            return;
        }

        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        if ($fileExtension === 'csv') {
            $this->fileParserContext->setStrategy(new CsvParser());
        } elseif ($fileExtension === 'json') {
            $this->fileParserContext->setStrategy(new JsonParser());
        } else {
            $this->error("Unsupported file format.");
            return;
        }

        $data = $this->fileParserContext->parse($filePath);
        $mappedData = $this->fieldMapper->map($data);

        foreach ($mappedData as $hotelData) {
            $command = new CreateHotelCommand(
                Str::uuid()->toString(),
                $hotelData['name'],
                $hotelData['image'],
                intval($hotelData['stars']),
                $hotelData['city'],
                $hotelData['description']
            );
            $this->commandBus->handle($command);
        }

        $this->info("Hotels imported successfully!");
    }
}
