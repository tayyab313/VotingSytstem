<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionCandidate extends Model
{
    use HasFactory;
    protected $table = "electioncandidate";
    protected $fillable = ["candidate_id","candidate_name","candidate_votes","document_id","status"];
}
