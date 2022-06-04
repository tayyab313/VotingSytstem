<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    protected $table = "elections";
    protected $fillable = ["election_name","start_date","end_date","start_time","end_time","election_position","status"];


    public function setElection_positionAttribute($value)
    {
        $this->attributes['election_position'] = json_encode($value);
    }
  
    /**
     * Get the categories
     *
     */
    public function getElection_positionAttribute($value)
    {
        return $this->attributes['election_position'] = json_decode($value);
    }
}
