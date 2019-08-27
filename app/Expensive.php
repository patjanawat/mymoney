<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expensive extends Model
{
    protected $table = 'expensives';
    protected $timestamp = true;
}
