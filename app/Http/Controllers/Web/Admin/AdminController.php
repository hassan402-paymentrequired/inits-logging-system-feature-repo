<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffCheckIns;
use App\Models\User;
use App\Models\Visitor;
use App\Models\VisitorHistories;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{

    /**
     * Summary of index
     * @return void
     */
    public function index(): View
    {
        $month = date('m'); 
        $year = date('Y');   
        $currently_checked_in_staff_for_the_month = StaffCheckIns::whereYear('check_in_time', $year)
            ->whereMonth('check_in_time', $month)
            ->with('user')
            ->get();

            $currently_checked_in_visitor_for_the_month = VisitorHistories::whereYear('check_in_time', $year)
            ->whereMonth('check_in_time', $month)
            ->with(['visitor.user'])
            ->get();

        $currently_checked_in_visitors = VisitorHistories::whereDate('check_in_time', date('Y-m-d'))->with(['visitor.user'])->get();
        $currently_checked_in_staff = StaffCheckIns::whereDate('check_in_time', date('Y-m-d'))->with('user')->get();
        
        return view('dash', [
            'currently_checked_in_visitors' => $currently_checked_in_visitors,
            'currently_checked_in_staff' => $currently_checked_in_staff,
            'staff_for_the_month' => $currently_checked_in_staff_for_the_month,
            'visitor_for_the_month' => $currently_checked_in_visitor_for_the_month
        ]);
    }
}
