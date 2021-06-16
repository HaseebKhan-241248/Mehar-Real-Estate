<?php

namespace App\Models\Blocks;

use App\Models\Sectors\Sector;
use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'sector_id',
        'project_id',
        'description',
        'status',
    ];
    public function ProjectName()
    {
        return  $this->hasOne(Project::class,'id','project_id');
    }
    public function SectorName()
    {
        return  $this->hasOne(Sector::class,'id','sector_id');
    }
    public static function createORupdateBlock($request)
    {
        $old =  Block::where('name',$request->name)->where('sector_id',$request->sector_id)->count();


        if($request->block_id>0)
        {
            request()->validate([
                'name'       => 'required',
                'sector_id'  => 'required',
                'project_id' => 'required'
            ]);
            parent::where('id',$request->block_id)->update([
                'name'        => $request->name,
                'sector_id'   => $request->sector_id,
                'project_id'  => $request->project_id,
                'description' => $request->description,
            ]);
            return [
                "status"  => 'success',
                "message" => 'Block Updated Successfully!'
            ];
        }
        else
        {
            request()->validate([
                'name'       => 'required',
                'sector_id'  => 'required',
                'project_id' => 'required'
            ]);
            if ($old>0)
            {
                return [
                    "status"  => 'success',
                    "message" => 'Block Already Exist Against this Sector!'
                ];
            }
            parent::create([
                'name'       => $request->name,
                'sector_id'  => $request->sector_id,
                'project_id'  => $request->project_id,
                'description'  => $request->description,
            ]);
            return [
                "status"  => 'success',
                "message" => 'Block Created Successfully!'
            ];
        }
    }
}
