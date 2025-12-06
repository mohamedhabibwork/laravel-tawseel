<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Enums;

enum OrderStatus: string
{
    case Created = 'Created';
    case Accepted = 'Accepted';
    case Rejected = 'Rejected';
    case Executed = 'Executed';
    case Canceled = 'Canceled';
}
