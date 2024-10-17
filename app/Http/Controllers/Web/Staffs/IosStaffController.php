<?php

namespace App\Http\Controllers\Web\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IosStaffController extends Controller
{
    

    public function index(Request $request)
    {
        $staffCurrentVisitors = auth()->user()->visitors()->with('visitorhistories')->whereDate('check_in_time', Carbon::now())->get();
        return view('staffs.dashboard', [
            'currentVisitors' => $staffCurrentVisitors,
        ]);
    }


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

}
