# Laravel Util

[![Build Status](https://travis-ci.org/orbasteam/util.svg?branch=master)](https://travis-ci.org/orbasteam/util)
[![StyleCI](https://styleci.io/repos/99010881/shield?branch=master)](https://styleci.io/repos/99010881)

Laravel Orbas Util provides some useful method, such like `enum` and `presenter`

## Installation

To get the latest version, simply require the project using [Composer](https://getcomposer.org):

`$ composer require orbas/util`

and register the `Orbas\Util\ServiceProvider::class` service provider in your `config/app.php`

## Enum

A enum is a distinct type that consists of a set of named constants called the enumerator list.

You can use it in a easier way to make your own enum.

### Create a enum class

`$ php artisan util:make:enum Gender`

That will create a class to `app/Enums/` folder

### Define the enum

 ```php
 <?php
 namespace App\Enums;
 
 use Orbas\Util\Enum\Enumable;
 
 class Gender implements Enumable
 {
     /**
      *
      * @return array
      */
     public function create()
     {
         return ['female', 'male'];
     }
 }
 ```
 
 or you can define the key

```php
<?php

namespace App\Enums;

use Orbas\Util\Enum\Enumable;

class Weekday implements Enumable
{
    /**
     *
     * @return array
     */
    public function create()
    {
        return [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday'
        ];
    }
}
```

### Enjoy using it

Generate a collection of gender

```php
app('enum')->create('gender');
```

Get value from key
```php
app('enum')->value(1, 'weekday'); // this will echo Monday  
```

More functionality will be release in the future.

## License

Laravel Util is licensed under [The MIT License (MIT)](LICENSE).