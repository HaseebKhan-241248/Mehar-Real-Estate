<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permission\Permission;
use App\Models\Projects\Project;
use Illuminate\Http\Request;
use Hash;
use Auth;

class AdminController extends Controller
{
    public function profile_page($user_id)
    {
        $data['user'] = User::where('id',$user_id)->first();
        return view('profiles.profile',$data);
    }
    public function update_profile_page(Request $request)
    {
//        dd($request->all());
        User::where('id',$request->user_id)->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
        return back()->withstatus(__("Profile Updated Successfully!"));
    }

    public function users_list ()
    {
        $data['users'] = User::where('role','=','0')->get();
        $data['counter'] = 1;
        return view('admin.users.list',$data);
    }
    public function create()
    {
        return view('admin.users.index');
    }

    public function store(Request $request)
    {
        // Permission::where('user_id',$request->user_id)->delete();
        // if($request->user_id>0)
        // {
        //     $user = User::where('id',$request->user_id)->update([
        //         'name'       => $request->name,
        //         'phone'      => $request->phone,
        //         'address'    => $request->address,
        //         'cnic'       => $request->cnic,
        //     ]);
        //     Permission::create([
        //         'permission' => $request->permission,
        //         'user_id'    => $request->user_id,
        //         'status'     => 1,
        //     ]);
        // }
        // else
        // {
            $validator = \Validator::make($request->all(), [
                'email' => ['required','unique:users' ],
            ]);
            if ($validator->fails())
            {
                echo "1";exit();
            }
            $user = User::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => Hash::make(12345678),
                'phone'      => $request->phone,
                'address'    => $request->address,
                'cnic'       => $request->cnic,
                'status'     => "Active",
                'created_by' => Auth::User()->id,
                'role'       => 0,
            ]);

            Permission::create([
                'permission' => $request->permission,
                'user_id'    => $user->id,
                'status'     => 1,
            ]);
        // }
    }
  
     public function edit($id)
     {
        $data['user'] = User::where('id',$id)->first();
        $data['permission'] = Permission::where('user_id',$id)->first();
        return view('admin.users.edit',$data);
     }    

     public function update(Request $request)
     {
        Permission::where('user_id',$request->user_id)->delete();
        $user = User::where('id',$request->user_id)->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make(12345678),
            'phone'      => $request->phone,
            'address'    => $request->address,
            'cnic'       => $request->cnic,
            'status'     => $request->status,            
            'created_by' => Auth::User()->id,
            'role'       => 0,
        ]);

        Permission::create([
            'permission' => $request->permission,
            'user_id'    => $request->user_id,
            'status'     => 1,
        ]);
     }

    public function assign_project()
    {
        $data['users'] = User::where('role','0')->get();
        $data['projects'] = Project::all();
        return view('admin.users.assign_project',$data);
    }

    public function save_assign_project(Request $request)
    {
        request()->validate([
            'user_id'    => 'required',
            'project_id' => 'required',      
        ]);
        User::where('id',$request->user_id)->update([
            'project_id' => $request->project_id,
        ]);
        return redirect()->back()->withstatus(__('Project Assigned Successfully!'));
    }

    public function update_permission()
    {
        $new_permission = [
            'name'        => 'Partners Share',
            'id'          => '7',
            'parent_id'   => '5',
            'operations'  => [],
        ];

        $new_permission = json_decode(json_encode($new_permission));
        $users = User::where('role','=','0')->get();
        foreach($users as $user)
        {
            $permission_object = Permission::where('user_id',$user->id)->first();
            $permissions =json_decode(($permission_object)->permission);
            array_push($permissions,$new_permission);        
            $permission_object->permission = json_encode($permissions);
            $permission_object->save();
        }
    }
    
}
