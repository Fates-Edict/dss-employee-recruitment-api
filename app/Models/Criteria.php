<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'master.criteria';
    protected $guarded = ['id'];
    public $searchable = [
        'name',
        'slug',
        'type'
    ];
}
