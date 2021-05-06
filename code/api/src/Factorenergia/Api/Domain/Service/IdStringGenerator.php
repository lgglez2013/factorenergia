<?php


namespace Factorenergia\Api\Domain\Service;


interface IdStringGenerator
{
    public function generate(): string;
}