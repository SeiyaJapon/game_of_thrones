<?php

return [
    'commands' => [
        \App\HotelsContext\Application\Hotel\Command\CreateHotelCommand::class => \App\HotelsContext\Application\Hotel\Command\CreateHotelCommandHandler::class,
        \App\HotelsContext\Application\Hotel\Command\UpdateHotelCommand::class => \App\HotelsContext\Application\Hotel\Command\UpdateHotelCommandHandler::class,
        \App\HotelsContext\Application\Hotel\Command\DeleteHotelCommand::class => \App\HotelsContext\Application\Hotel\Command\DeleteHotelCommandHandler::class,
    ],
    'queries' => [
        \App\HotelsContext\Application\Hotel\Query\ListHotelQuery::class => \App\HotelsContext\Application\Hotel\Query\ListHotelQueryHandler::class,
        \App\HotelsContext\Application\Hotel\Query\GetHotelQuery::class => \App\HotelsContext\Application\Hotel\Query\GetHotelQueryHandler::class,
    ],
];