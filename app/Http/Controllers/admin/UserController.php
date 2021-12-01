<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMedia;
use \Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $userQuery = User::where('id','>',0);

        
        $users = $userQuery->paginate(10);
        return view('admin.users.index', compact('users'));
    }

  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = \Config::get("constants.user_roles"); 
       
        
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|max:190',
            
            'role'      => 'required|max:45',
            'email'     => 'required|max:190|email|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($request->input('password'));
        $user = new User();
        $user->fill($input);
        $user->save();
        return redirect(route('admin.users.index'))->with('flash_success', 'User created successfully.');
    }
    public function dropzone(Request $request,$id)
    {
        $user = User::find($id);
        
        return view('admin.users.dropzone', compact('user'));
    }
    public function dropzoneStore(Request $request,$id)
    {
        
        $image = $request->file('file');
        
        $imageName = $image->getClientOriginalName();

        $image->move(public_path('images'), $imageName);

        $imageUpload = new UserMedia();
        
        $imageUpload->user_id = $id;
        $imageUpload->avatar = $imageName;
        $imageUpload->save();

        return response()->json([
            'status' => 1,
            'filename' => $imageName
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $image = UserMedia::where('user_id',$user->id)->orderBy('updated_at','desc')->first();
        
       
       return view('admin.users.profile',compact('user','image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = User::find($id);
        $roles = \Config::get("constants.user_roles"); 
        
        return view('admin.users.edit', compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
       
        $request->validate([
            'name'      => 'required|max:190',
           
            'role'      => 'required|max:45', 
            'email'     => 'required|max:190|email',
            'password'  => ['nullable', 'string', 'min:8', 'confirmed'],
            
        ]);
        $input = $request->except('password');

        if ($request->filled('password'))
            $input['password'] = Hash::make($request->input('password'));

        $user->fill($input);
        $user->save();
        return redirect(route('admin.users.index'))->with('flash_success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        User::find($id)->delete();
        
        return redirect(route('admin.users.index'))->with('flash_success', 'User deleted successfully.');
    }
}
