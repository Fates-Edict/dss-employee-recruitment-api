<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaAlternatives extends Model
{
    use HasFactory;

    protected $table = 'master.criteria_alternatives';
    protected $guarded = ['id'];
    public $searchable = [
        'alternative_id'
    ];

    public function Alternative()
    {
        return $this->belongsTo(Alternatives::class, 'alternative_id', '');
    }

    public function Criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
