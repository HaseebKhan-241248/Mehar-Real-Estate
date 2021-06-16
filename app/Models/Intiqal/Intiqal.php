<?php

namespace App\Models\Intiqal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intiqal extends Model
{
    protected $fillable = [
        'booking_id',
        'intiqal_no',
        'intiqal',
        'intiqal_attachment',
        'description',
        'type',
        'status',
    ];
    use HasFactory;

    public static function saveIntiqal($request)
    {
        request()->validate([
            'intiqal_no'         => ['required', 'unique:intiqals'],
            'intiqal_attachment' => ['required'],
            'intiqal'            => ['required'],
        ]);
        $ScanFile ="";
        if ($request->hasFile('intiqal_attachment'))
        {
            if($request->file('intiqal_attachment')->isValid()) {
                $random = '3333'.rand(10000000,900000000);
                $file1 = $request->file('intiqal_attachment');
                $name1 =  $file1->getClientOriginalName();
                $request->file('intiqal_attachment')->move("public/files/IntiqalAttachments/",$random." ".$name1);
                $ScanFile = "public/files/IntiqalAttachments/".$random." ".$name1."";
            }
        }
        parent::create([
            'booking_id'         => $request->booking_id,
            'intiqal_no'         => $request->intiqal_no,
            'intiqal'            => $request->intiqal,
            'intiqal_attachment' => $ScanFile,
            'description'        => $request->description,
            'type'               => 'Intiqal',
            'status'             => '1',
        ]);
        return [
            'message'=> "Intiqal Saved Successfully!"
        ];
    }

    public static function saveIntiqalBooking($request,$booking_id)
    {
        // request()->validate([
        //     'intiqal_no'       => ['required', 'unique:intiqals'],
        // ]);

      
        if ($request->hasFile('intiqal_attachment'))
        {
//            dd("fas");
            if($request->file('intiqal_attachment')->isValid())
            {
                $random = '3333'.rand(10000000,900000000);
                
                $file1  = $request->file('intiqal_attachment');
                $name1  = $file1->getClientOriginalName();
                $request->file('intiqal_attachment')->move("public/files/IntiqalAttachments/$random"."$name1");
                $S = "public/files/IntiqalAttachments/$random"."$name1";
              
                parent::create([
                    'booking_id'         => $booking_id,
                    'intiqal_no'         => $request->intiqal_no,
                    'intiqal'            => $request->intiqal_a,
                    'intiqal_attachment' => $S,
                    'description'        => "",
                    'type'               => 'Intiqal',
                    'status'             => '1',
                ]);
            }
            // dd($ScanFile1);
        }
       
    }
}
