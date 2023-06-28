<?php

namespace Neverlxsss\Monobank\Support;

use Mockery\Exception;

class SaveCardData
{
    public bool $saveCard;
    public string $walletId;

    public function __construct(
        bool $saveCard,
        string $walletId = null
    )
    {
        $this->saveCard = $saveCard;
        $this->walletId = $walletId;
    }
}
