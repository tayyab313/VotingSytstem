<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electionsinformation extends Model
{
    use HasFactory;
    protected $table = 'electionsinformations';
    protected $fillable=[
        'state_code',
        'state_name',
        'city_code',
        'city_name',
        'parroquia_code',
        'parroquia_name',
        'Circunscripcion',
        'zone_code',
        'zone_name',
        'zone_voters',
        'male_voters',
        'female_voters',
        'zone_tables',
        'male_tables',
        'female_tables',
        'voters_per_table',
    ];
}
