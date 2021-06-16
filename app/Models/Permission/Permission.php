<?php

namespace App\Models\Permission;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'permission',
        'user_id',
        'type',
        'status',
    ];
    use HasFactory;
    public function UserPermissions() {
        return $this->belongsTo(User::class );
    }
}
