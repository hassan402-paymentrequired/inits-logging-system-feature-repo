<?php

namespace App\Http\Controllers\Api\Staffs;

use App\Http\Controllers\Controller;
use App\Services\StaffService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffsController extends Controller
{
    protected StaffService $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }
    public function getStaffVisitors(Request $request)
    {
        return $this->respondWithProxyData(
            $this->staffService->getStaffVisitors($request)
        );
    }

    public function getStaffCheckInHistory(Request $request)
    {
        return $this->respondWithProxyData(
            $this->staffService->getStaffCheckInHistory($request)
        );
    }

    public function getTotalCurrentGuest(Request $request)
    {
        return $this->respondWithProxyData(
            $this->staffService->getTotalCurrentGuest($request)
        );
    }
   
}