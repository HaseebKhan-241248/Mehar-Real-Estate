<?php

namespace App\Models\Boooking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookgingattachment extends Model
{
    protected $fillable = [
        'booking_id',
        'attachments',
        'comments',
    ];
    use HasFactory;
    public static function saveAttachments($request,$bookingId)
    {

        $arr = [];

        foreach ($request->comments as $comment) {
            $bookingAttachment = parent::create([
                'booking_id'   => $bookingId,
                'comments'     => $comment
            ]);
            array_push($arr,$bookingAttachment->id);
        }

        foreach ($request->attachments as $key => $attachment) {
            if($attachment) {
                $name = $attachment->getClientOriginalName();
                $path = 'uploads/file/BookingAttachments';
                $fileName = $path.'/'.$name."".$bookingAttachment->id;
                $attachment->move($path,$name);
            }
            parent::where('id','=',$arr[$key])->update([
                'attachments' => $fileName,
            ]);
        }
    }
    public static function  UpdateAttachments($request,$bookingId)
    {
//dd("d");
        parent::where('booking_id',$bookingId)->delete();
        $arr = [];
//dd(isset($request->comments));
        if(isset($request->comments))
        {
            foreach ($request->comments as $key => $comment) {
                $bookingAttachment = parent::create([
                    'booking_id'   => $bookingId,
                    'comments'     => $comment
                ]);

//            print_r($request->attachments[$key]);
                if(isset($request->attachments[$key]))
                {
//                dd($request->attachments[$key]);
                    $name     = $request->attachments[$key]->getClientOriginalName();
                    $path     = 'uploads/file/BookingAttachments';
                    $fileName = $path.'/'.$name."".$bookingAttachment->id;
                    $request->attachments[$key]->move($path,$name);
                    if(isset($request->old_attachments[$key])  && file_exists(public_path($request->old_attachments[$key])) )
                    {
                        unlink($request->old_attachments[$key]);
                    }
                }
                else
                {
                    $fileName = $request->old_attachments[$key];
//                    echo $fileName;
                }
                array_push($arr,$bookingAttachment->id);
                parent::where('id','=',$bookingAttachment->id)->update([
                    'attachments' => $fileName,
                ]);
            }
        }

    }
}
