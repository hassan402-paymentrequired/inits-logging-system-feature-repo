<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\StaffCheckIns;
use App\Models\User;
use App\Models\Visitor;
use App\Models\VisitorHistories;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{

    public function index(Request $request): View
    {
        // Get the selected date from the request or default to today
        $selectedDate = $request->input('selected_date', date('Y-m-d')); // Defaults to today's date

        // Get the month and year from the selected date
        $month = date('m', strtotime($selectedDate));
        $year = date('Y', strtotime($selectedDate));

        // Get checked-in staff for the month
        $checked_in_staff_for_the_month = StaffCheckIns::whereYear('check_in_time', $year)
            ->whereMonth('check_in_time', $month)
            ->with('user')
            ->get();

        // Get checked-in visitors for the month
        $checked_in_visitors_for_the_month = VisitorHistories::whereYear('check_in_time', $year)
            ->whereMonth('check_in_time', $month)
            ->with(['visitor.user'])
            ->get();

        // Get checked-in visitors for the selected date
        $checked_in_visitors_today = VisitorHistories::whereDate('check_in_time', $selectedDate)
            ->with(['visitor.user'])
            ->paginate(10);

        // Get checked-in staff for the selected date
        $checked_in_staff_today = StaffCheckIns::whereDate('check_in_time', $selectedDate)
            ->with('user')
            ->paginate(10);

        // Get checked-in visitors for yesterday (if needed)
        $checked_in_visitors_yesterday = VisitorHistories::whereDate('check_in_time', now()->subDay())
            ->with(['visitor.user'])
            ->get();

        // Get checked-in staff for yesterday (if needed)
        $checked_in_staff_yesterday = StaffCheckIns::whereDate('check_in_time', now()->subDay())
            ->with('user')
            ->get();

        // Count the number of staff checked in for the selected date
        $number_of_checked_in_staff_today = $checked_in_staff_today->count();

        // Gender count for staff for the month
        $staff_gender_count = [
            'male' => $checked_in_staff_for_the_month->where('user.gender', 'male')->count(),
            'female' => $checked_in_staff_for_the_month->where('user.gender', 'female')->count(),
        ];

        // dd($staff_gender_count);
        // Filter only male visitors
        $male_visitors = $checked_in_visitors_for_the_month->filter(function ($checkIn) {
            return $checkIn['visitor']['gender'] === 'male';
        });
        // Filter only female visitors
        $female_visitors = $checked_in_visitors_for_the_month->filter(function ($checkIn) {
            return $checkIn['visitor']['gender'] === 'female';
        });

        // Gender count for visitors for the month
        $visitor_gender_count = [
            'male' =>  $male_visitors->count(),
            'female' => $female_visitors->count()
        ];


        return view('dashboard.index', [
            'checked_in_visitors_today' => $checked_in_visitors_today,
            'checked_in_staff_today' => $checked_in_staff_today,
            'staff_for_the_month' => $checked_in_staff_for_the_month,
            'visitor_for_the_month' => $checked_in_visitors_for_the_month,
            'number_of_checked_in_staff_today' => $number_of_checked_in_staff_today,
            'checked_in_staff_yesterday' => $checked_in_staff_yesterday,
            'checked_in_visitors_yesterday' => $checked_in_visitors_yesterday,
            'selectedDate' => $selectedDate,
            'staff_gender_count' => $staff_gender_count,
            'visitor_gender_count' => $visitor_gender_count,
        ]);
    }

   public function notifications() {
        return view('notifications.index');
    }

    public function function () {
        return view('analytics.index');
    }

    function geofence() {
        return view('geofencing.index');
    }

    public function getAllTheVisitorForTheMonth(Request $request)
    {
        // Get the number of entries per page from the request, defaulting to 10
        $perPage = $request->input('per_page', 10);

        // Get the search query from the request
        $search = $request->input('search', '');

        $staffs = Role::where('name', 'Staff')->with('users')->get();

        // Build the query
        $visitors_for_the_month = VisitorHistories::whereMonth('check_in_time', date('m'))
            ->whereYear('check_in_time', date('Y'))
            ->with(['visitor.user'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('visitor', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('phone_number', 'like', "%{$search}%");
                });
            })
            ->paginate($perPage);

            
// dd($staffs);

        return view('visitors.index', [
            'visitors_for_the_month' => $visitors_for_the_month,
            'staffs' => $staffs,
            'search' => $search, // Pass the search query to the view
            'perPage' => $perPage, // Pass the per page value to the view
        ]); 
    }

    public function createNewStaff(Request $request)
    {
        dd($request->all());
    }

}
