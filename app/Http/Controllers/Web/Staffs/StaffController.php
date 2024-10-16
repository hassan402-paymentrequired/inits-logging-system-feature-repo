<?php

namespace App\Http\Controllers\Web\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Services\StaffService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{

    protected StaffService $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }


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
        $user = User::with('role')->find($id)->first();

        return view('staffs.show');

    }

     /**
     * Display the specified resource.
     */

     public function edit(string $id)
     {
        $staff = User::find($id)->with('role')->first();
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
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }

        User::created([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        return redirect('/v1/staffs');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id)->first();
        $user->update([
            'is_active' => 0
        ]);
        return redirect()->back()->with('success', 'user deactived successfully');
    }

       /**
      * staff actions
      *
      */

    /**
     * View all staff history
     * @param User $id
     * @return User 
     */

     public function getStaffCheckInHistory()
     {
         $staffHistory = auth()->user()->staffcheckins()->get();

         return view('info', ['history' => $staffHistory]);

     }

      public function getStaffCurrentVisitors()
      {
        $staffCurrentVisitors = auth()->user()->visitors()->with('visitorhistories')->whereDate('check_in_time', Carbon::now())->get();

        return view('info', ['current_visitors' => $staffCurrentVisitors]);
      }

      public function getStaffVisitorsHistory()
      {
        $staffVisitorsHistory = auth()->user()->visitors()->with('visitorhistories')->get();

        //TODO: return redirect
      }
}
