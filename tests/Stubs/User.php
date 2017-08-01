<?php
namespace Tests\Stubs;

use Illuminate\Database\Eloquent\Model;

use Orbas\Util\Traits\Presenter;
use Tests\Stubs\Presenter\UserPresenter;

class User extends Model
{
    use Presenter;

    public function getPresenter()
    {
        return UserPresenter::class;
    }
    
    public function getFirstNameAttribute()
    {
        return 'ivan';
    }

    public function getLastNameAttribute()
    {
        return 'wu';
    }

    public function getGenderAttribute()
    {
        return 1;
    }
}