<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Enums;

enum LookupType: string
{
    case Authorities = 'authorities-list';
    case CancellationReasons = 'cancellation-reasons-list';
    case Regions = 'regions-list';
    case Categories = 'categories-list';
    case IdentityTypes = 'identity-types-list';
    case PaymentMethods = 'payment-methods-list';
    case CarTypes = 'car-types-list';
    case Countries = 'countries-list';
    case Cities = 'cities-list';
}
