<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Medico extends Authenticatable
{
    protected $table = 'medicos';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
