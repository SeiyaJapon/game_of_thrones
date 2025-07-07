<?php

declare (strict_types=1);


namespace App\ShareContext\Application\Query;

abstract class AbstractQueryResultCollection implements QueryResultInterface
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = array_map(function ($item) {
            $this->assertItemIsValid($item);
            return $item;
        }, $items);
    }

    public function result(): array
    {
        return array_map(function (QueryResultInterface $item) {
            return $item->result();
        }, $this->items);
    }

    private function assertItemIsValid(mixed $value)
    {
        if (!value instanceof QueryResultInterface) {
            throw new \InvalidArgumentException('Item must be an instance of QueryResultInterface');
        }
    }
}
