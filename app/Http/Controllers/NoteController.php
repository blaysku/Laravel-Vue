<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Instance of Note.
     */
    private $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note = $this->note->with('user')->latest()->get();

        return response()->json($note);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //Validation
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|min:10',
        ]);
        //Store note
        $this->note->user_id = $user->inRandomOrder()->value('id');
        $this->note->name = $request->name;
        $this->note->description = $request->description;
        $this->note->save();
        //Response
        return response()->json([
            'success' => true,
            'notes' => $this->note->with('user')->latest()->get(),
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json([
            'msg' => 'The note has been deleted.',
        ]);
    }
}
