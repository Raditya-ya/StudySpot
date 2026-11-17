<?php

namespace App\Http\Controllers;

use App\Models\StudentNote;
use App\Models\TempatBelajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentNoteController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string|min:5|max:500',
        ], [
            'note.required' => 'Catatan tidak boleh kosong.',
            'note.min' => 'Catatan minimal terdiri dari 5 karakter.',
            'note.max' => 'Catatan maksimal 500 karakter.',
        ]);

        $place = TempatBelajar::findOrFail($id);

        StudentNote::create([
            'user_id' => Auth::id(),
            'tempat_belajar_id' => $place->id,
            'note' => $request->note,
        ]);

        return redirect()->route('places.show', $place->id)
            ->withFragment('catatan-mahasiswa')
            ->with('note_success', 'Catatan berhasil ditambahkan!');
    }

    public function destroy(Request $request, $id)
    {
        $note = StudentNote::findOrFail($id);
        $user = $request->user();

        if (!$user || ($user->id !== $note->user_id && $user->role !== 'admin')) {
            abort(403);
        }

        $placeId = $note->tempat_belajar_id;
        $note->delete();

        return redirect()->route('places.show', $placeId)
            ->withFragment('catatan-mahasiswa')
            ->with('note_success', 'Catatan berhasil dihapus.');
    }
}