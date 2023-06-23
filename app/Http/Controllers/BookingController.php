<?php

namespace App\Http\Controllers;

use App\Models\ScheduleClass;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = auth()->user()->bookings()->upcoming()->get();
        return view('member.upcoming')->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $scheduledClasses = ScheduleClass::upcoming()
            ->notBooked()
            ->with('classType', 'instructor')
            ->oldest('date_time')->get();

        return view('member.book')->with('scheduleClasses', $scheduledClasses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        auth()->user()->bookings()->attach($request->schedule_class_id);
        return redirect()->route('bookings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
        auth()->user()->bookings()->detach($id);
        return redirect()->route('bookings.index');
    }
}
