<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'tokens';

    protected $fillable = ['typeform_token'];
	
}