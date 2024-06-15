<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user()
    {
        $data['getRecord'] = User::getUser();
       return view('admin.user.list', $data);
    }

    public function add_user(Request $request)
    {
        return view('admin.user.add');
    }

    public function insert_user(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->status = trim($request->status);
        $user->save();

        return redirect('admin/user/list')->with('success', "User Successfully Created");
    }

    public function edit_user($id)
    {
        $data['getRecord'] = User::getSingle($id);
        return view('admin.user.edit', $data);
    }

    public function update_user($id,Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->status = trim($request->status);
        $user->save();

        return redirect('admin/user/list')->with('success', "User Successfully Updated");
    }

    public function delete_user($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/user/list')->with('error', "Your data deleted successfully");
    }

    public function ChangePassword()
    {
        return view('admin.user.change_password');
    }

    public function UpdatePassword(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);

        if(Hash::check($request->old_password,$user->password))
        {
             if($request->new_password == $request->confirm_password)
             {
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->back()->with('success', "Your password has been updated");
             }
             else
             {
                return redirect()->back()->with('error', "Confirm password does not match with the new password");
             }
        }
        else
        {
            return redirect()->back()->with('error', "Old password does not match");
        }
    }

    public function AccountSetting()
    {
        $data['getUser'] = User::getSingle(Auth::user()->id);
        return view('admin.profile.account_setting',$data);
    }

    public function UpdateAccountSetting(Request $request)
    {
        $getUser = User::getSingle(Auth::user()->id);
        $getUser->name = $request->name;

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($getUser->profile_pic) && file_exists('upload/profile/'.$getUser->profile_pic))
        {
            unlink('upload/profile/'.$getUser->profile_pic);
        }

         $ext = $request->file('profile_pic')->getClientOriginalExtension();
         $file = $request->file('profile_pic');
         $filename = Str::random(20).'.'.$ext;
         $file->move('upload/profile/',$filename);
         $getUser->profile_pic = $filename;
        }
        $getUser->save();

        return redirect()->back()->with('success', "Your Account Successfully Updated");
    }
}