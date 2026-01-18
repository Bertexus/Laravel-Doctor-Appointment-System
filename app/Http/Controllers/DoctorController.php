<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $users = User::where('role_id','!=',3)->get();
        return view('admin.doctor.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function validateStore($request){
        $this->validate($request,[
            'name' => ['required'],
            'email' => ['required','email','unique:users'],
            'password' => ['required','min:6','max:25'],
            'gender'=>['required'],
            'education' => ['required'],
            'address' => ['required'],
            'department' => ['required'],
            'phone_number' => ['required','numeric'],
            'image' => ['required','mimes:jpeg,jpg,png'],
            'role_id' => ['required'],
            'description' => ['required']
        ]);
     }

    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();
        $name = (new User)->userAvatar($request);

        $data['image'] = $name;
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->back()->with('message', 'Doctor added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('admin.doctor.delete',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.doctor.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function validateUpdate($request, $id){
        $this->validate($request,[
            'name' => ['required'],
            'email' => ['required','unique:users,email,'. $id],
            
            'gender'=>['required'],
            'education' => ['required'],
            'address' => ['required'],
            'department' => ['required'],
            'phone_number' => ['required','numeric'],
            'image' => ['mimes:jpeg,jpg,png'],
            'role_id' => ['required'],
            'description' => ['required']
        ]);
     }

    public function update(Request $request, string $id)
    {
        $this->validateUpdate($request, $id);
        $data = $request->all();
        $user = User::find($id);
        $imageName = $user->image;
        $userPassword = $user->password;

        if($request->hasFile('image')){
            $imageName = $name = (new User)->userAvatar($request);
            unlink(public_path('images/'.$user->image));
        }
        $data['image'] = $imageName;

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }else{
            $data['password'] = $userPassword;
        }

        $user->update($data);

        return redirect()->route('doctor.index')->with('message', 'Doctor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(auth()->user()->id == $id){
            abort(401);
        } 
        $user = User::find($id);
        $userDelete = $user->delete();
        if($userDelete){
            unlink(public_path('images/'.$user->image));
        }
        return redirect()->route('doctor.index')->with('message', 'Doctor deleted successfully');

    }
}
