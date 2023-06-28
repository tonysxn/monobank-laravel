<?php

namespace Neverlxsss\Monobank\Facades;

use Illuminate\Support\Facades\Facade;

class Monobank extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'monobank';
    }
}
