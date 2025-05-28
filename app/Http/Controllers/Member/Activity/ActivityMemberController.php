<?php

namespace App\Http\Controllers\Member\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityMemberController extends Controller
{
    public function activity()
    {
        $activities = Activity::paginate(8); // 8 items per page, sesuaikan jika perlu
        return view('Member.Activity.activity', compact('activities'));
    }

    public function show(Activity $activity)
    {
        // Get other activities for the related activities slider (excluding current activity)
        $otherActivities = Activity::where('id', '!=', $activity->id)
                                ->latest('date')
                                ->take(6)
                                ->get();
        
        // Change this line to use detail-act instead of show
        return view('Member.Activity.detail-act', compact('activity', 'otherActivities'));
    }
}