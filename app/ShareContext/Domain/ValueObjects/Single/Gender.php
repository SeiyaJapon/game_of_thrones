<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

/**
 * @method static Gender male()
 * @method static Gender female()
 */
class Gender extends AbstractStringEnum
{
    public const MALE = 'MALE';
    public const FEMALE = 'FEMALE';

}
