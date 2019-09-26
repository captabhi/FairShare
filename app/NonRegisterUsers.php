<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class NonRegisterUsers extends Model
{
    protected $table = 'non_register_users';

    public function generateHash()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $hash = "";
        for($i = 0; $i <16; $i++)
        {
            $index =rand(0,strlen($characters)-1);
            $hash = $characters[$index];
        }
        return $hash;
    }

    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }

}
