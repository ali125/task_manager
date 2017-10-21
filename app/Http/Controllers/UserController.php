<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Contact;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function edit(Request $request){

        $user = User::find(Auth::user()->id);

        if( $request->isMethod('post') ){
            $validator = $this->validate($request, array(
                'name'  => 'nullable|string|max:255',
                'last_name'  => 'nullable|string|max:255',
                'email'  => 'nullable|string|email|max:255',
                'mobile' => 'required|size:11',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ));

            $image = $request->file('image');
            if($image){
                $filename = time().'.'.$image->getClientOriginalExtension();

                $destinationPath = public_path('/upload/avatar/');
            
                $image->move($destinationPath, $filename);
                $user->image = $filename;
            }
            
            $user->name = $request->input('name');
            $user->last_name = $request->input('last_name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            
            $user->save();
            return redirect()->route('settings');
        }

        return view('dashboard/user/edit', $user);
    }

    public function add(Request $request, $project_id){
        if( $request->isMethod('post') ){
            $this->validate($request, array(
                'mobile' => 'required|size:11',
            ));
            $user = new User();
           
            $find_user = $user->find_by_mobile($request->input('mobile'));

            // $user->last_name = $request->input('first_name');
            // $user->last_name = $request->input('last_name');
            if(!$find_user){
                $user->mobile = $request->input('mobile');
                $user->password = bcrypt("password");
                $user->save();
                $user->projects()->attach($project_id, ['role' => $request->input('role')]);
            }else{
                $is_in_project = $user->is_in_project($find_user->id, $project_id)->first();
                if($is_in_project == null){
                    $user->id = $find_user->id;
                    $user->projects()->attach($project_id, ['role' => $request->input('role')]);
                }else{
                    $request->session()->flash('error_message', 'This Phone already in this project!');
                    return redirect()->back();
                }
                
            }
            
            
            
            // $contact = new Contact();
            // $contact->user_id = Auth::id();
            // $contact->first_name = $request->input('first_name');
            // $contact->last_name = $request->input('last_name');
            // $contact->belongs_to = $user->id;
            // $contact->save();
            return redirect()->route('view_project', ['project_id' => $project_id]);
        }
        return view('dashboard/user/add');
    }
    
    
}
