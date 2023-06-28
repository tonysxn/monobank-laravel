# Laravel Monobank
A Laravel package for the Monobank

## Instalation
```
composer require neverlxsss/monobank-laravel
```

Add a ServiceProvider to your providers array in `config/app.php`:
```php
    'providers' => [
    	//other things here

    	Neverlxsss\Monobank\MonobankServiceProvider::class,
    ];
```

Add the facade to the facades array:
```php
    'aliases' => [
    	//other things here

    	'Monobank' => Neverlxsss\Monobank\Facades\Monobank::class,
    ];
```

Finally, publish the configuration files:
```
php artisan vendor:publish --provider="Neverlxsss\Monobank\MonobankServiceProvider"
```

### Configuration
Please set your API: `MONOBANK_TOKEN` in the `.env` file 
