<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $guarded = [];

    public function scopeMaincategories ($query) {
        return $query ->whereNull('parent_id');
    }

    public function scopeSubcategories ($query) {
        return $query ->whereNotNull('parent_id');
    }

    public function getActive () {
        return $this -> is_active == 1 ? 'Enabled' : 'Disabled';
    }

    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/categories/' . $val) : "";
    }

    public function scopeActive($query) {
        return $query -> where('is_active',1);
    }

    //get all parents=
    public function _parents(){
        return $this -> belongsTo(Self::class,'parent_id');
    }

}
