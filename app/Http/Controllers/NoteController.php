<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required',
            'value' => 'required',
            'user_id' => 'required',
        ]);

        $note = new Note();
        $note->location_id = $request->input('location_id');
        $note->value = $request->input('value');
        $note->user_id = $request->input('user_id');
        $note->save();
        return redirect()->back()->with('success', 'Note ajoute avec succes');
    }
}
