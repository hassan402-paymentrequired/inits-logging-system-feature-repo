<?php

namespace App\Http\Controllers\Web\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = User::with('role')->get();
        return view('dashboard.staff', ['staffs' => $staff]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required' ,
            'email' => 'required|email',
            'phone_number' => 'required',
             'role' => 'required'
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }

        $role = Role::where('name' , $request->role)->first();

         User::created([
            'name' => $request->name,
            'phone_number' => $request->phone_number ,
            'role_id' => $role->id ,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);

        return redirect(route('dashboard'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required' ,
            'email' => 'required|email',
            'phone_number' => 'required',
            'role' => 'required'
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }

        $role = Role::where('name' , $request->role)->first();

        User::created([
            'name' => $request->name,
            'phone_number' => $request->phone_number ,
            'role_id' => $role->id ,
            'email' => $request->email,
        ]);

        return redirect(route('dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // $user->role()->is_active = true;
    }
}
