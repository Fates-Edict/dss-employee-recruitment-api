<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulations extends Model
{
    use HasFactory;

    protected $table = 'master.simulations';
    protected $guarded = ['id'];
    public $searchable = [
        'job_vacancy_id',
    ];

    public function JobVacancy()
    {
        return $this->belongsTo(JobVacancies::class);
    }
}
