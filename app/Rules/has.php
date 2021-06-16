<?php

namespace App\Rules;

use App\Models\Permission\Permission;
use Illuminate\Contracts\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class has implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
    public static function permission($module,$operation)
    {
        $permission = Permission::where('user_id',FacadesAuth::user()->id)->first();
        if($permission) {
            $permissions = json_decode($permission->permission);


            foreach ($permissions as $permission) {
                if ($permission->name == $module) {
                    return in_array($operation, $permission->operations);
                }
            }
        }
    //    dd($permission);
    }
}
