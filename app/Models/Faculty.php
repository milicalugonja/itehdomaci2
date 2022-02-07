<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    
    protected $fillable=['name','address','scientific_field','university_id'];

    public function university(){
        return $this->belongsTo(University::class);
    }
}
