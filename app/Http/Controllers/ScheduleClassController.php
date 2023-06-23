<?php

namespace App\Http\Controllers;

use App\Events\ClassCanceled;
use App\Models\ClassType;
use App\Models\ScheduleClass;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class ScheduleClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduledClasses = auth()->user()->scheduleClasses()->upcoming()->oldest('date_time')->get();
        return view('instructor.upcomingClasses')->with('scheduledClasses', $scheduledClasses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassType::all();
        return view('instructor.schedule')->with('classTypes', $classes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date_time = $request->input('date') . " " . $request->input('time');

        $request->merge([
            'date_time' => $date_time,
            'instructor_id' => auth()->user()->id,
        ]);

        $validated = $request->validate([
            'class_type_id' => 'required',
            'instructor_id' => 'required',
            'date_time' => 'required|unique:schedule_classes,date_time|after:now'
        ]);


        // dd($validated);
        ScheduleClass::create($validated);

        return redirect()->route('schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduleClass $schedule)
    {
        // if (auth()->user()->id !== $schedule->instructor_id) {
        //     abort(HttpResponse::HTTP_FORBIDDEN);
        // }

        if (auth()->user()->cannot('delete', $schedule)) {
            abort(HttpResponse::HTTP_FORBIDDEN);
        }

        ClassCanceled::dispatch($schedule);

        // $schedule->delete();
        // $schedule->members()->detach();

        return redirect()->route('schedule.index');
    }
}
