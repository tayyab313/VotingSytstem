<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemElectionCandidate extends Model
{
    use HasFactory;
    protected $table = 'system_election_candidates';
    
    
    protected $fillable = array(
        'name',
        'email',
        'password',
        'phone',
        'position',
        'political_party',
        'state',
        'city',
        'parroquia',
        'election_id'
      );
}
