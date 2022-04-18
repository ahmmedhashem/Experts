<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Data;

class ActMiss implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $data_id;
    private $mission_id;



    public function __construct($data_id,$mission_id)
    {
        $this -> data_id = $data_id;
        $this -> mission_id = $mission_id;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
         if($this -> data_id) //edit form
            $attribute = Data::where('activity_id', $value)->where('mission_id',$this->mission_id)->where('id','!=',$this->data_id) -> first();
        else  //creation form
            $attribute = Data::where('activity_id', $value)->where('mission_id',$this->mission_id)->first();

        if ($attribute)
            return false;
        else
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'هذه البيانات موجوده من قبل';
    }
}
