<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'candidates';

    protected $fillable = [
        'name',
        'surnames',
        'birth_date',
        'nationality',
        'email',
        'phone',
        'register_date',
        'user_account',
        'points',
        'description',
        'selected'
    ];
	
}
