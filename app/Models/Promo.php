<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'promos';

    protected $fillable = [
        'school_id',
        'name',
        'ubication',
        'start_date',
        'duration',
        'image',
        'url',
        'code'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}