<?php

namespace App\Models\Plots;

use App\Models\Accounts\Account;
use App\Models\Blocks\Block;
use App\Models\Projects\Project;
use App\Models\Sectors\Sector;
use App\Models\Marla;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp;
use  Unirest\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class Plot extends Model
{
    use HasFactory;
    protected $fillable = [
        'sector_id',
        'marla_id',
        'project_id',
        'description',
        'status',
        'block_id',
        'name'
    ];
    public function BlockName()
    {
        return  $this->hasOne(Block::class,'id','block_id');
    }
    public function ProjectName()
    {
        return  $this->hasOne(Project::class,'id','project_id');
    }
    public function SectorName()
    {
        return  $this->hasOne(Sector::class,'id','sector_id');
    }
    public function MarlaSize()
    {
        return  $this->hasOne(Marla::class,'id','marla_id');
    }
    public static function createORupdatePlot($request)
    {
        $old = Plot::where('name',$request->name)->where('block_id',$request->block_id)->count();

        // else
        //     {
        if($request->plot_id>0)
        {
            request()->validate([
                'name'       => 'required',
                'block_id'   => 'required',
                'project_id' => 'required',
                'sector_id'  => 'required',
            ]);
            parent::where('id',$request->plot_id)->update([
                'name'        => $request->name,
                'block_id'    => $request->block_id,
                'marla_id'    => $request->marla_id,
                'sector_id'   => $request->sector_id,
                'project_id'  => $request->project_id,
                'description' => $request->description,
            ]);
            return [
                "status"  => 'success',
                "message" => 'Plot Updated Successfully!'
            ];
        }
        else
        {
            request()->validate([
                'name'       => 'required',
                'block_id'   => 'required',
                'project_id' => 'required',
                'sector_id'  => 'required',
            ]);
            if ($old>0)
            {
                return [
                    "status"  => 'success',
                    "message" => 'Plot Already Exist Against this Block!'
                ];
            }
           $plot = parent::create([
                'name'        => $request->name,
                'block_id'    => $request->block_id,
                'marla_id'    => $request->marla_id,
                'sector_id'   => $request->sector_id,
                'project_id'  => $request->project_id,
                'description' => $request->description,
                'status'      => 1,
            ]);
            ////// creating a account of plot /////////////////
            $account = Account::savePlotAccount($plot->id,$request->name,$request->project_id);
            parent::where('id',$plot->id)->update(['account_id' => $account->id]);
            ////// update the plot table iserting account_id///
            return [
                "status"  => 'success',
                "message" => 'Plot Added Successfully!'
            ];
        }
        // }
    }
}
