<?php

namespace Neverlxsss\Monobank\Support;

use Mockery\Exception;

class MerchantPaymentInfo
{
    public string $reference;
    public string $destination;
    public array $basketOrder;

    public function __construct(
        string $reference = null,
        string $destination = null,
        array $basketOrder = null,
    )
    {
        $this->reference = $reference;
        $this->destination = $destination;


        if ($basketOrder) {
            foreach ($basketOrder as $order) {
                if (typeOf($order) != BasketOrder::class) {
                    throw new Exception("Basket order should be BasketOrder::class type");
                }
            }
        }

        $this->basketOrder = $basketOrder;
    }
}
