<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitie extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'criteria_id',
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

    public function criteria()
    {
        return $this->belongsTo(Main_criteria::class,'criteria_id');
    }

    public function getActive () {
    return $this -> is_active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function scopeActive($query) {
        return $query -> where('is_active',1);
    }

    public function data()
    {
        return $this->hasMany(Data::class,'activity_id');
    }



}
