<?php

namespace Neverlxsss\Monobank\Support;

enum PaymentType: string
{
    case DEBIT = "debit";
    case HOLD = "hold";
}
