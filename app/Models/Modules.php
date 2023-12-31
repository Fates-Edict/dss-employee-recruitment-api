<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    use HasFactory;

    protected $table = 'master.modules';
    protected $guarded = ['id'];
    public $searchable = [
        'name',
        'slug',
    ];
}
