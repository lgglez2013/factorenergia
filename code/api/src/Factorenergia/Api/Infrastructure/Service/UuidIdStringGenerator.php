<?php


namespace Factorenergia\Api\Infrastructure\Service;

use Ramsey\Uuid\Uuid;
use Factorenergia\Api\Domain\Service\IdStringGenerator;

class UuidIdStringGenerator implements IdStringGenerator
{
    public function generate(): string
    {
        return Uuid::uuid4();
    }

}