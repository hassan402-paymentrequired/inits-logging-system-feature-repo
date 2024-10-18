<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Services\AuthenticationService;
use App\Services\StaffService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    protected StaffService $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }



    /**
     * Display the specified resource.
     */
    public function show( Request $request, string $id)
    {
        $search = $request->selected_month;
        $staffHistories = User::with(['staffcheckins' =>  function ($query) use ($search){
            $query->whereYear('check_in_time', date('Y'));
            $query->whereMonth('check_in_time', $search ? $search : date('m'));
        }])->find($id);

        $groupedByWeek = $staffHistories->staffcheckins->groupBy(function ($checkin) {
            return Carbon::parse($checkin->check_in_time)->startOfWeek()->format('W'); // Week number
        });
        return view('staffs.show', ['staff' => $groupedByWeek]);
    }

    /**
     * Display the specified resource.
     */

    public function edit(string $id)
    {
        $staff = User::find($id)->with('role')->first();
        if (!$staff) {
            return redirect()->route('staffs.index')->with('error', 'Staff not found');
        }
        return view('staffs.edit', ['staff' => $staff]);
    }


    /**
     * Update a staff
     * @param  User $data
     * @param User $id
     * redirect to route named staff
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Invalid credentials');
        }

       $user =  User::where('email', $request->email)->first();


       $user->update([
        'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
       ]);

        return redirect(route('staffs'));
    }


    public function store(Request $request)
    {
        try {
            $staff_credentials = Validator::make($request->all(), [
                'name' => 'required',
                'phone_number' => 'required',
                'email' => 'required|unique:users,email'
            ]);
    
            if($staff_credentials->fails())
            {
                return redirect()->back()->with('erorr', 'Invalid credentials');
            }

            $role_id = Role::where('name', 'Staff')->first();
    
            User::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => 'password',
                'is_active' => 1,
                'role_id' => $role_id->id
            ]);
    
            return redirect()->back()->with('success', 'staff created successfully');
            
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Network error'.$exception->getMessage());
        }
    }

    /**
     * set staff an inactive
     * @param User $id
     * redirect back
     */
    public function destroy(string $id)
    {
        $user = User::find($id)->first();
        $user->update([
            'is_active' => 0
        ]);
        return redirect()->back()->with('success', 'user deactived successfully');
    }

    
}
