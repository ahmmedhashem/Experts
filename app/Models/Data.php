<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'datas';

    protected $fillable = [
        'activity_id',
        'mission_id',
        'rule_id',
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

    public function activity()
    {
        return $this->belongsTo(Activitie::class,'activity_id');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class,'mission_id');
    }
}
