<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{

    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $table = 'billings';

}
