<?php

namespace App\Models\Sectors;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $fillable = ['project_id','name','description','status'];

    public function ProjectName()
    {
        return  $this->hasOne(Project::class,'id','project_id');
    }
    public static function createORupdateSector($request)
    {

        $old = Sector::where('name',$request->name)->where('project_id',$request->project_id)->count();
        // if ($old>0)
        // {
        //     return [
        //         "status"  => 'success',
        //         "message" => 'Sector Already Exist Against this Project!'
        //     ];
        // }
        // else
        // {
            if($request->sector_id>0)
            {
                request()->validate([
                    'name'       => 'required',
                    'project_id' => 'required'
                ]);
                parent::where('id',$request->sector_id)->update([
                    'name'       => $request->name,
                    'project_id' => $request->project_id,
                    'description'=> $request->description,
                    // 'status'     => $request->status,
                ]);
                return [
                    "status"  => 'success',
                    "message" => 'Sector Updated Successfully!'
                ];
            }
            else
            {
                request()->validate([
                    'name'       => 'required',
                    'project_id' => 'required',
                ]);
                  if ($old>0)
        {
            return [
                "status"  => 'success',
                "message" => 'Sector Already Exist Against this Project!'
            ];
        }
                parent::create([
                    'name'       => $request->name,
                    'project_id' => $request->project_id,
                    'description'=> $request->description,
                    'status'     => "Active",
                ]);
                return [
                    "status"  => 'success',
                    "message" => 'Sector Created Successfully!'
                ];
            }
        // }

    }
}
