<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'aid';//主键
    public $timestamps = false;
    public $table = 'admin';
}
