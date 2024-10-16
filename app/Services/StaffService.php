<?php

namespace App\Services;

use App\Models\User;
use App\Models\Visitor;
use App\Models\VisitorHistories;
use App\Supports\Interfaces\StaffServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffService implements StaffServiceInterface
{


    public function getStaffVisitors(Request $request)
    {
        return auth()->guard('api')->user()->visitors()->with('visitorhistories')->get();
    }

    public function getStaffCheckInHistory(Request $request)
    {
        return auth()->guard('api')->user()->staffcheckins()->get();
    }

    public function getTotalCurrentGuest(Request $request)
    {
        return auth()->guard('api')->user()->visitors()
            ->with('visitorhistories')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->whereDay('created_at', date('d'))
            ->get();
    }
}
