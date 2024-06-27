<?php

namespace Src\Database\Entities;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "tbl_customer";
    public $timestamps = false;
}