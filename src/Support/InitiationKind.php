<?php

namespace Neverlxsss\Monobank\Support;

enum InitiationKind: string
{
    case MERCHANT = "merchant";
    case CLIENT = "client";
}
