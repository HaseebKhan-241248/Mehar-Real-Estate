<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignPartner extends Model
{
    use HasFactory;
    protected $fillable = ['project_id','partner_id','percentage_hold','status'];

    
}
