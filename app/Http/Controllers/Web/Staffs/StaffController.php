<?php

namespace App\Http\Controllers\Web\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Services\AuthenticationService;
use App\Services\StaffService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{

    protected AuthenticationService $authenticationService;
    protected StaffService $staffService;

    public function __construct(StaffService $staffService, AuthenticationService $authenticationService)
    {
        $this->staffService = $staffService;
        $this->authenticationService = $authenticationService;
    }


    


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $staffCurrentVisitors = auth()->user()->visitors()->with('visitorhistories')->whereDate('check_in_time', Carbon::now())->get();
        return view('staffs.dashboard', [
            'currentVisitors' => $staffCurrentVisitors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffs = User::whereHas('role', function($query) {
            $query->where('name', 'Staff');
        })->get();
        return view('auth.staff-login', ['staffs' => $staffs]);
    }

    


    public function login(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required"
        ]);

        if($credentials->fails()){
            return redirect()->back()->with("error", "Invalid credentials");
        }

        $remember_me = $request->rememberMe ? true : false;

         $response =  $this->authenticationService->webLogin($request->email, $request->password, $remember_me );

         if($response['status'] == 400) {
            return redirect()->back()->with("error", "Invalid email or password");
        }
        return redirect()->intended(route('staff.dashboard'))->with("success", "Logged in successfully");
     }


     public function logout(Request $request)
     {
        $this->authenticationService->webLogout($request);
        return redirect('/v1');

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

    //  public function getStaffCheckInHistory()
    //  {
    //      $staffHistory = auth()->user()->staffcheckins()->get();

    //      return view('info', ['history' => $staffHistory]);

    //  }

    //   public function getStaffCurrentVisitors()

    //     $staffCurrentVisitors = auth()->user()->visitors()->with('visitorhistories')->whereDate('check_in_time', Carbon::now())->get();


    //     return view('info', ['current_visitors' => $staffCurrentVisitors]);
    //   }

    //   public function getStaffVisitorsHistory()
    //   {

    //     //TODO: return redirect
    //   }
=
}
