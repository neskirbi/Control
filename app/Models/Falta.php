<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Falta extends Model
{
    protected $table = 'faltas';
    protected $primaryKey = 'id';
    public $incrementing = false;
}
