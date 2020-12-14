<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model
{
    public function slagdata()
    {
        $x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $x = str_shuffle($x);
        $slag = substr($x,0,5);
        return $slag;
    }
}
