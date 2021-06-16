<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marla extends Model
{
    use HasFactory;
    protected $fillable =['marla','description','type'];


     public static function saveMarls($request)
    {
        if($request->marla_id>0)
        {
            request()->validate([
                'marla'       => 'required',
            ]);
            parent::where('id',$request->marla_id)->update([
                'marla'        => $request->marla,                
                'description' => $request->description,               
            ]);
            return [
                "status"  => 'success',
                "message" => 'Marla Updated Successfully!'
            ];
        }
        else
        {
            request()->validate([
                'marla'       => ['required', 'unique:marlas'],
            ]);
            parent::create([
                'marla'        => $request->marla,               
                'description' => $request->description,              
            ]);
            return [
                "status"  => 'success',
                "message" => 'Marla Created Successfully!'
            ];
        }
    }
}
