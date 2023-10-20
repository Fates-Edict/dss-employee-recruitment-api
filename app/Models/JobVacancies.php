<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancies extends Model
{
    use HasFactory;

    protected $table = 'master.job_vacancies';
    protected $guarded = ['id'];
    public $searchable = [
        'name',
        'slug',
    ];
}
