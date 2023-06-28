<?php

namespace Neverlxsss\Monobank\Support;

use Mockery\Exception;

class BasketOrder
{
    public string $name;
    public int $quantity;
    public int $sum;
    public string $icon;
    public string $unit;
    public string $code;
    public string $barcode;
    public string $header;
    public string $footer;
    public array $tax;
    public string $uktzed;

    public function __construct(
        string $name,
        int $quantity,
        int $sum,
        string $icon = null,
        string $unit = null,
        string $code = null,
        string $barcode = null,
        string $header = null,
        string $footer = null,
        array $tax = null,
        string $uktzed = null,
    )
    {
        if (empty($name)) {
            throw new Exception("Name is required for BasketOrder");
        }

        if ($quantity <= 0) {
            throw new Exception("Quantity for BasketOrder should be a positive number");
        }

        if  ($sum <= 0) {
            throw new Exception("Sum for BasketOrder should be a positive number");
        }

        $this->name = $name;
        $this->quantity = $quantity;
        $this->sum = $sum;
        $this->icon = $icon;
        $this->unit = $unit;
        $this->code = $code;
        $this->barcode = $barcode;
        $this->header = $header;
        $this->footer = $footer;
        $this->tax = $tax;
        $this->uktzed = $uktzed;
    }
}
