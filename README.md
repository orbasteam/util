# Laravel Util

[![Build Status](https://travis-ci.org/orbasteam/util.svg?branch=master)](https://travis-ci.org/orbasteam/util)
[![StyleCI](https://styleci.io/repos/99010881/shield?branch=master)](https://styleci.io/repos/99010881)

Laravel Util provides some useful method, such like `enum` and `presenter`

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

### Use Facade

Add class aliases to the aliases array of `config/app.php`:

```php
  'aliases' => [
    // ...
      'Enum' => \Orbas\Util\Facades\Enum::class,
    // ...
  ],
```

then you can use it like this

```php
// equal to app('enum')->create('gender');
Enum::create('gender');
Enum::gender();
```

*More functionality will be released in the future.*

## Presenter

or you can call it view presenter. Sometimes you have some logic need to be performed before you put the data. 

for example

```php
{{ $user->first_name }} {{ $user->last_name }}
{{ $user->gender == 0 ? 'female' : 'male' }}
{{ Carbon\Carbon::parse($user->birthday->format('d/m/Y') }}
```

A presenter is a pattern that you can put the logic far from view and model. (keep model clean, and do what it should do.)

### Create a presenter class

`$ php artisan util:make:presenter User`

That will create a class to `app/Presenters` folder

### Edit your presenter logic

```php
namespace App\Presenters;

use Orbas\Util\Presenter;

class User extends Presenter
{
    public function full_name()
    {
        return $this->attribute('first_name') . ' ' . $this->last_name;
    }
    
    public function birthday()
    {
        return Carbon\Carbon::parse($this->attribute('')
    }
}
```

### Put present trait to your model

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orbas\Util\Traits\Presenter;

class User extends Model
{
    use Presenter;   
}
```

### Usage

```php
$user = App\User::find(1);

$user->present()->full_name;

// or
$user->present('full_name');
```

### Multi-language with Enum

Presenter provides auto translation. 

Put `enums.php` to `resources/lang/YOUR_LOCALE/enums.php` 

```php
// resources/lang/zh-TW/enums.php
return [
    'gender' => [    // enum name
        'female' => '女',    // enum key => translation word
        'male'   => '男'
    ]
];
```

Presenter will translate for you

```php
$user = App\User::first();
$user->present('gender');
// or
$user->present()->gender;
```

## License

Laravel Util is licensed under [The MIT License (MIT)](LICENSE).