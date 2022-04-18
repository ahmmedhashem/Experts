<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;


    protected $table = 'missions';

    protected $fillable = [
        'role_id',
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

    public function rule()
    {
        return $this->belongsTo(Role::class,'role_id');
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
