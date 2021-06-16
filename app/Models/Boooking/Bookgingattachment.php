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
                'comments'    => $comment
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
}
