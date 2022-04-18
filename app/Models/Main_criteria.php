<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_criteria extends Model
{
    use HasFactory;

    protected $table = 'main_criterias';

    protected $fillable = [
        'slug',
        'name',
        'is_active',
        'created_at',
        'updated_at'
    ];


    //to make casting to the data type
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getActive () {
        return $this -> is_active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function scopeActive($query) {
        return $query -> where('is_active',1);
    }

    public function activities()
    {
        return $this->hasMany(Activitie::class,'criteria_id');
    }

}
