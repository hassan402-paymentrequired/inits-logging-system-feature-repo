<?php

namespace App\Http\Controllers\Web\Visitors;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'admin_id' => $request->admin_id
        ])->visitorhistories()->create([
            'check_in_time' => date('Y-m-d H:i:s'),
            'check_out_time' => null,
            'duration_time' => null,
        ]);

        dd("hello world");
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
