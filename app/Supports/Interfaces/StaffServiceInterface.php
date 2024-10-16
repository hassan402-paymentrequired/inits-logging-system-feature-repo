<?php

namespace App\Supports\Interfaces;

use Illuminate\Http\Request;

interface StaffServiceInterface
{
    public function getStaffVisitors(Request $request);

    public function getStaffCheckInHistory(Request $request);

    public function getTotalCurrentGuest(Request $request);
    
}