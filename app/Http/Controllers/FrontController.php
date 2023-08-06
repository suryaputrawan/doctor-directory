<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    function index()
    {
        $schedules = Schedule::orderBy('room_id')->get()
            ->groupBy('room.location.name');

        return view('front', [
            'schedules'     => $schedules,
            'date'          => Carbon::now()->format('d M Y')
        ]);
    }
}
