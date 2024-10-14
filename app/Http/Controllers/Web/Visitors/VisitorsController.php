<?php

namespace App\Http\Controllers\Web\Visitors;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Visitor;
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

        $visitors_infos = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'phone_number' => 'required',
            'staff' => 'required|email|exists:users,email'
        ]);

        if($visitors_infos->fails())
        {
            return redirect()->back()->withErrors($visitors_infos);
        }
        $staff = User::where('email', $request->staff)->first();
        if(!$staff)
        {
            return redirect()->back()->with('invalid', 'No staff found with the provided email');
        }
        $visitor_already_exist = Visitor::where('name',$request->name)->first();
        if($visitor_already_exist){
            $visitor_already_exist->visitorhistories()->create([
                'check_in_time' =>date('Y-m-d H:i:s'),
                'check_out_time' => null,
                'duration_time' => null,
            ]);

            return redirect('/dash'); //TODO: enywhere you want to redirect them to dash does not exist
        }

        $visitor = Visitor::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'purpose_of_visit' => $request->purpose_of_visit,
            'staff_id' => $staff->id,
            'admin_id' => auth()->user()->id
        ])->visitorhistories()->create([
            'check_in_time' => date('Y-m-d H:i:s'),
            'check_out_time' => null,
            'duration_time' => null,
        ]);
        return redirect(route('visitors'))->with('success', 'Visitor created and checked in successfully!');
    }

    /**
     * Display the specified resource.
     */
    // public function edit(Visitor $visitor)
    // {
    //     $visitor = $visitor->load('user', 'visitorhistories');
    //     return view('visitor', ['visitor' => $visitor]);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visitor $visitor)
    {
        $visitors_infos = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'phone_number' => 'required',
            'staff' => 'required|email|exists:users,email'
        ]);

        if($visitors_infos->fails())
        {
            return redirect()->back()->withErrors($visitors_infos);
        }

        $staff = User::where('email', $request->staff)->first();
        if(!$staff)
        {
            return redirect()->back()->with('invalid', 'No staff found with the provided email');
        }

        $visitor->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'purpose_of_visit' => $request->purpose_of_visit,
            'staff_id' => $staff->id,
            'admin_id' => Auth::id()
        ]);

        return redirect('/v1/visitors');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function checkOut(Visitor $visitor)
    {
        $visitor->visitorhistories()->update([
            'check_out_time' => date('Y-m-d H:i:s')
        ]);

        return redirect("/v1/visitors");
    }
}
