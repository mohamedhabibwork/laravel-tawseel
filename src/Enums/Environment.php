<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Enums;

enum Environment: string
{
    case Test = 'test';
    case Production = 'production';
}
