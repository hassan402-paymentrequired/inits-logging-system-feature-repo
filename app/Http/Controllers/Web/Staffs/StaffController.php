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
    public function index(Request $request)
    {
        $staffs = User::with('role')
        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->paginate($request->get('per_page', 10));
        
        // Default to 10 entries per page
    

    return view('staffs.index', ['staffs' => $staffs]);
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
     * Display the specified resource.
     */

     public function edit(string $id)
     {
        $staff = User::find($id)->with('role')->first();
        // dd($user);
 // Check if staff exists
        if (!$staff) {
        return redirect()->route('staffs.index')->with('error', 'Staff not found');
    }
    return view('staffs.edit', compact('staff'));
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
            // 'role' => 'required'
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }

        $role = Role::where('name' , $request->role)->first();

        User::created([
            'name' => $request->name,
            'phone_number' => $request->phone_number ,
            // 'role_id' => $role->id ,
            'email' => $request->email,
        ]);

        return redirect('v1/staffs');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // $user->role()->is_active = true;
    }
}
