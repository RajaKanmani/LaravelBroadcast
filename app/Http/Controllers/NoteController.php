<?php

namespace App\Http\Controllers;

use App\Note;
use App\Events\NoteCreated;
use App\Events\NoteUpdate;
use App\Events\NoteDestroy;

use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all()->sortByDesc('created_at');
        return NoteResource::collection($notes);
    }

    public function store(Request $request)
    {
        $note = new Note();
        $note->fill($request->all());
        $note->save();

        // sleep(5);
        // return response()->json([
        //     'data' => [
        //         'uuid' => $note->uuid,
        //         'message' => 'Some error occured',
        //         'data' => []
        //     ]
        // ], 400);

       // return new NoteResource($note);

       broadcast(new NoteCreated($note))->toOthers(); // broadcast to all including current user

        return response()->json([
            'data' => [
                'uuid' => $note->uuid,
                'message' => 'Successfully Created',
                'data' => []
            ]
        ], 200);

        // return new NoteResource($note);
    }

    public function show(Note $note)
    {
        return new NoteResource($note);
    }

    public function edit(Note $note)
    {
        return new NoteResource($note->load('user'));
    }

    public function update(Request $request)
    {
        $note = Note::where('uuid', $request->uuid)->first();
        $note->description = $request->description;
        $note->save();

        //sleep(5);

        broadcast(new NoteUpdate($note))->toOthers();

        return new NoteResource($note);
    }

    public function destroy($note_id)
    {
        $note = Note::where('uuid', $note_id)->first();

       // sleep(5);

        $note->delete();

        broadcast(new NoteDestroy($note))->toOthers();

        return response()->json([
            'data' => [
                'uuid' => $note->uuid,
                'message' => 'Note has been deleted.',
                'data' => []
            ]
        ], 200);
    }

    public function fetch_completed()
    {
        $notes = Note::where('completed', true)->orderBy('created_at', 'asc')->get();
        return NoteResource::collection($notes);
    }

    public function fetch_pending()
    {
        $notes = Note::where('completed', false)->orderBy('created_at', 'desc')->get();
        return NoteResource::collection($notes);
    }
}
