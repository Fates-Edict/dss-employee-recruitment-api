<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatives extends Model
{
    use HasFactory;

    protected $table = 'master.alternatives';
    protected $guarded = ['id'];
    public $searchable = [
        'name'
    ];

    public function CriteriaAlternatives()
    {
        return $this->hasMany(CriteriaAlternatives::class, 'alternative_id', 'id');
    }
}
