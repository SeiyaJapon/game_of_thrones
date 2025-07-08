<?php

return [
    'commands' => [
        \App\GOTCastingContext\Application\Actor\Command\CreateActor\CreateActorCommand::class => \App\GOTCastingContext\Application\Actor\Command\CreateActor\CreateActorCommandHandler::class,
        \App\GOTCastingContext\Application\Actor\Command\UpdateActorById\UpdateActorByIdCommand::class => \App\GOTCastingContext\Application\Actor\Command\UpdateActorById\UpdateActorByIdCommandHandler::class,
        \App\GOTCastingContext\Application\Actor\Command\DeleteActorById\DeleteActorByIdCommand::class => \App\GOTCastingContext\Application\Actor\Command\DeleteActorById\DeleteActorByIdCommandHandler::class,
        \App\GOTCastingContext\Application\Character\Command\CreateCharacter\CreateCharacterCommand::class => \App\GOTCastingContext\Application\Character\Command\CreateCharacter\CreateCharacterCommandHandler::class,
        \App\GOTCastingContext\Application\Character\Command\UpdateCharacter\UpdateCharacterCommand::class => \App\GOTCastingContext\Application\Character\Command\UpdateCharacter\UpdateCharacterCommandHandler::class,
        \App\GOTCastingContext\Application\Character\Command\DeleteCharacter\DeleteCharacterCommand::class => \App\GOTCastingContext\Application\Character\Command\DeleteCharacter\DeleteCharacterCommandHandler::class,
        \App\GOTCastingContext\Application\Character\Command\LinkCharacterToActor\LinkCharacterToActorCommand::class => \App\GOTCastingContext\Application\Character\Command\LinkCharacterToActor\LinkCharacterToActorCommandHandler::class,
    ],
    'queries' => [
        \App\GOTCastingContext\Application\Actor\Query\GetActorById\GetActorByIdQuery::class => \App\GOTCastingContext\Application\Actor\Query\GetActorById\GetActorByIdQueryHandler::class,
        \App\GOTCastingContext\Application\Actor\Query\ListActors\ListActorsQuery::class => \App\GOTCastingContext\Application\Actor\Query\ListActors\ListActorsQueryHandler::class,
        \App\GOTCastingContext\Application\Actor\Query\SearchActors\SearchActorsQuery::class => \App\GOTCastingContext\Application\Actor\Query\SearchActors\SearchActorsQueryHandler::class,
        \App\GOTCastingContext\Application\Character\Query\GetCharacterById\GetCharacterByIdQuery::class => \App\GOTCastingContext\Application\Character\Query\GetCharacterById\GetCharacterByIdQueryHandler::class,
        \App\GOTCastingContext\Application\Character\Query\ListCharacters\ListCharactersQuery::class => \App\GOTCastingContext\Application\Character\Query\ListCharacters\ListCharactersQueryHandler::class,
        \App\GOTCastingContext\Application\Character\Query\SearchCharacters\SearchCharactersQuery::class => \App\GOTCastingContext\Application\Character\Query\SearchCharacters\SearchCharactersQueryHandler::class,
    ],
];