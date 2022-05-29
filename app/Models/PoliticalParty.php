<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticalParty extends Model
{
    use HasFactory;
    protected $table = 'political_party';
    
    
    protected $fillable = array(
        'party_logo',
        'party_name',
        'party_level',
        'election_id'
      );
}
