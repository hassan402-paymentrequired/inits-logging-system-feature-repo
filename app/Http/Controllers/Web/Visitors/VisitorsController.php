<?php

namespace App\Http\Controllers\Web\Visitors;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Visitor;
use App\Services\SendVisitorsNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VisitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Visitor $visitor)
    {
       //TODO:move here
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate incoming data
        $visitors_infos = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'phone_number' => 'required',
            'staff' => 'required|email|exists:users,email',
            'purpose_of_visit' => 'required'
        ]);

        // Check if validation fails
        if($visitors_infos->fails()) {

            return redirect()->back()->with('error', 'invalid infos');
        }



        // Find the staff by email
        $staff = User::where('email', $request->staff)->first();

        if(!$staff) {
            return redirect()->back()->with('invalid', 'No staff found with the provided email');
        }

        // Check if visitor already exists
        $visitor_already_exist = Visitor::where('name', $request->name)->first();

        if($visitor_already_exist) {
            // Create a visitor history for the existing visitor
            $visitor_already_exist->visitorhistories()->create([
                'check_in_time' => now(),
                'check_out_time' => null,
                'duration_time' => null,
            ]);
    
            SendVisitorsNotificationService::send('Yooooo! bro common check it out. You have a visitor down here with the name'.$request->name );

           // Redirect to a valid route
            return redirect()->route('dashboard')->with('success', 'Visitor checked in successfully');

        }
    
        // If visitor doesn't exist, create a new visitor and history
        $new_visitor = Visitor::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'purpose_of_visit' => $request->purpose_of_visit,
            'staff_id' => $staff->id,
            'admin_id' => Auth::id()
        ]);
    
        $new_visitor->visitorhistories()->create([
            'check_in_time' => now(),
            'check_out_time' => null,
            'duration_time' => null,
        ]);

        SendVisitorsNotificationService::send('Yooooo! bro common check it out. You have a visitor down here with the name'.$request->name );

        // Redirect to a valid route after successful check-in
        return redirect()->route('dashboard')->with('success', ' Checked in Visitor successfully');

    }
    

    /**
     * Display the specified resource.
     */
    public function show(Visitor $visitor)
    {
        $visitor = $visitor->load('user');
        return view('visitors.show', ['visitor' => $visitor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visitor $visitor)
    {

        // dd($request);
        $visitors_infos = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'phone_number' => 'required',
            // 'staff' => 'required|email|exists:users,email'
        ]);

        if($visitors_infos->fails())
        {
            return redirect()->back()->withErrors($visitors_infos);
        }

        // $staff = User::where('email', $request->staff)->first();
        // if(!$staff)
        // {
        //     return redirect()->back()->with('invalid', 'No staff found with the provided email');
        // }

        $visitor->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'purpose_of_visit' => $request->purpose_of_visit,
            // 'staff_id' => $staff->id,
            'admin_id' => Auth::id()
        ]);

        return redirect('v1/visitors');
    }

    
//       Remove the specified resource from storage.
   public function checkOut(string $id)
    {
        // Get the visitor along with today's visitor history
        $visitor = Visitor::with(['visitorhistories' => function ($query) {
            $query->whereYear('created_at', date('Y'))
                  ->whereMonth('created_at', date('m'))
                  ->whereDay('created_at', date('d'));
        }])->find($id);

       
       
        if ($visitor && $visitor->visitorhistories->isNotEmpty()) {
            $visitor->visitorhistories->first()->update([
                'check_out_time' => now(), 
            ]);

         
        } else {
            return redirect()->back()->withErrors('No check-in record found for this visitor today.');
        }
    
        return redirect("/v1/admin/dashboard")->with('success', 'Visitor checked out successfully.');
    }
}