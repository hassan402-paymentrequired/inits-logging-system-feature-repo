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
                'admin_id' => Auth::id()
            ]);
    
            SendVisitorsNotificationService::send();
            return redirect()->route('visitors')->with('success', 'Visitor checked in successfully');
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

    
        // Redirect to a valid route after successful check-in
        return redirect()->route('visitors')->with('success', ' Checked in Visitor successfully');

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
    public function edit(Visitor $visitor)
    {
        $visitor = $visitor->load('user');
        return view('visitors.edit', ['visitor' => $visitor]);
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

    /**
     * Remove the specified resource from storage.
     */
    public function checkOut(string $id)
    {

        $visitor = Visitor::with(['visitorhistories' => function ($query) {
            $query->whereYear('check_in_time', date('Y'))
                  ->where('check_out_time', null)
                  ->whereMonth('check_in_time', date('m'))
                  ->whereDay('check_in_time', date('d'));
        }])->find($id);

       dd($visitor);
    
        if ($visitor && $visitor->visitorhistories->isNotEmpty()) {
            // Update the check_out_time for today's history
            $visitor->visitorhistories->first()->update([
                'check_out_time' => now(), // Use Laravel's helper for current timestamp
            ]);
        // dd($visitor);

    
            // Optionally, you can log or dump the visitor history here
            // dd($visitor->visitorhistories);
        } else {
            // Handle the case when no matching visitor or history is found
            return redirect()->back()->withErrors('No check-in record found for this visitor today.');
        }
    
        return redirect("/v1/visitors")->with('success', 'Visitor checked out successfully.');
    }}
