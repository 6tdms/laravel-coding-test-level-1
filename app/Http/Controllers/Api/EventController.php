<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function allEvents()
    {
        $events = Event::all();
        return response()->json([
            "success" => true,
            "message" => "Event List",
            "data" => $events
        ]);
    }

    public function activeEvents()
    {
        $currentDate = Carbon::now();
        $events = Event::where('startAt', '>=', $currentDate)->where('endAt', '<=', $currentDate)->get();
        return response()->json([
            "success" => true,
            "message" => "Active Event List",
            "data" => $events
        ]);
    }

    public function show($id)
    {
        $events = Event::find($id);
        if (is_null($events)) {
            return $this->sendError('Product not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Event retrieved successfully.",
            "data" => $events
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $event = Event::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Event created successfully.",
            "data" => $event
        ]);
    }

    public function createOrUpdate(Request $request)
    {
        foreach($request as $r){
            Event::updateOrCreate(
                ['id' => $r->id],
                ['name' => $r->name,
                'startAt' => $r->startAt,
                'endAt' => $r->endAt]
            );
        }
        return response()->json([
            "success" => true,
            "message" => "Event updated/created successfully."
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $event=Event::findOrFail($request->id);
        $event->update($request->all());
        return response()->json([
            "success" => true,
            "message" => "Event updated successfully.",
            "data" => $event
        ]);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json([
            "success" => true,
            "message" => "Event has been deleted."
        ]);
    }
}
