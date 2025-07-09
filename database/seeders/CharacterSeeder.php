<?php

namespace Database\Seeders;

use App\GOTCastingContext\Domain\Actor\Actor;
use App\GOTCastingContext\Infrastructure\Actor\Persistence\ElasticsearchActorRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Character as EloquentCharacter;
use App\Models\Actor as EloquentActor;
use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorName;
use App\GOTCastingContext\Domain\Character\Character;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use App\GOTCastingContext\Infrastructure\Character\Persistence\ElasticsearchCharacterRepository;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/got-characters.json');
        $json = File::get($path);
        $charactersData = json_decode($json, true);

        $client = ClientBuilder::create()
            ->setHosts([config('services.elasticsearch.host')])
            ->build();

        $searchActorRepository = new ElasticsearchActorRepository($client);
        $elasticsearchCharacterRepository = new ElasticsearchCharacterRepository($client);

        if (!isset($charactersData['characters']) || !is_array($charactersData['characters'])) {
            $characters = $charactersData;
        } else {
            $characters = $charactersData['characters'];
        }

        foreach ($characters as $data) {
            $actorId = null;

            if (isset($data['actorName'])) {
                $actor = EloquentActor::firstOrCreate(
                    ['name' => $data['actorName']],
                    ['id' => Uuid::uuid4()->toString()]
                );
                $actorId = $actor->id;

                $domainActor = new Actor(
                    new ActorId($actor->id),
                    new ActorName($actor->name)
                );

                $searchActorRepository->index($domainActor);
            }

            $characterId = Uuid::uuid4()->toString();

            $now = Carbon::now();

            try {
                $characterDataForDb = [
                    'id' => $characterId,
                    'name' => $data['characterName'],
                    'actor_id' => $actorId,
                    'house_name' => $data['houseName'] ?? null,
                    'nickname' => $data['nickname'] ?? null,
                    'character_image_thumb' => $data['characterImageThumb'] ?? null,
                    'character_image_full' => $data['characterImageFull'] ?? null,
                    'siblings' => json_encode($data['siblings'] ?? []),
                    'parents' => json_encode($data['parents'] ?? []),
                    'killed' => json_encode($data['killed'] ?? []),
                    'guarded_by' => json_encode($data['guardedBy'] ?? []),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                DB::table('characters')->updateOrInsert(
                    ['id' => $characterId],
                    $characterDataForDb
                );

                $character = new Character(
                    new CharacterId($characterId),
                    new CharacterName($data['characterName']),
                    $actorId ? new ActorId($actorId) : null,
                    $data['houseName'] ?? null,
                    $data['nickname'] ?? null,
                    $data['characterImageThumb'] ?? null,
                    $data['characterImageFull'] ?? null,
                    $data['siblings'] ?? [],
                    $data['parents'] ?? [],
                    $data['killed'] ?? [],
                    $data['guardedBy'] ?? []
                );

                $elasticsearchCharacterRepository->index($character);
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
            }
        }
    }
}