<?php

namespace App\Supports\Interfaces;

use Illuminate\Http\Request;

interface StaffServiceInterface
{
    public function getStaffVisitors( );

    public function getStaffCheckInHistory( );

    public function getTotalCurrentGuest( );
    
}