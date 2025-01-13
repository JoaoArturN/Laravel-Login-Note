<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // carregar as notas do usuário

        $id = session('user.id');

        $user = User::find($id);

        $notes = User::find($id)->notes()->get();

        // mostrar a home view

        return view('home', ['notes' => $notes]);
    }

    public function newNotes()
    {
        return view('new_note');
    }

    public function newNoteSubmit(Request $request)
    {

        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000',
            ],
            [
                'text_title.required' => 'O campo de título é obrigatório',
                'text_title.min' => 'O titulo deve ter pelo menos 3 caracteres',
                'text_title.max' => 'O titulo deve ter no máximo 200 caracteres',
                'text_note.required' => 'O campo de nota é obrigatório',
                'text_note.min' => 'A nota deve ter pelo menos 3 caracteres',
                'text_note.max' => 'A nota deve ter no máximo 3000 caracteres',
            ]
        );

        // pegar o id do usuario

        $id = session('user.id');

        // criar a nota

        $note = new Note;
        $note->user_id = $id;
        $note->title = $request->input('text_title');
        $note->text = $request->input('text_note');
        $note->save();

        // redirecionar para a home

        return redirect()->route('main');

    }

    public function edit($id)
    {

        $id = Operations::decrypt($id);

        // carregar nota
        $note = Note::find($id);

        return view('edit_note', ['note' => $note]);
    }

    public function delete($id)
    {

        $id = Operations::decrypt($id);

        // carregar a nota

        $note = Note::find($id);

        // mostrar view

        return view('delete_note', ['note' => $note]);
    }

    public function deleteConfirm($id)
    {

        // verifica se o id está encriptado

        $id = Operations::decrypt($id);

        // carrega nota

        $note = Note::find($id);

        // hard delete

        $note->delete();

        // soft delete

        // redirecionar para a home

        return redirect()->route('main');

    }

    public function editSubmit(Request $request)
    {

        // validate request

        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000',
            ],
            [
                'text_title.required' => 'O campo de título é obrigatório',
                'text_title.min' => 'O titulo deve ter pelo menos 3 caracteres',
                'text_title.max' => 'O titulo deve ter no máximo 200 caracteres',
                'text_note.required' => 'O campo de nota é obrigatório',
                'text_note.min' => 'A nota deve ter pelo menos 3 caracteres',
                'text_note.max' => 'A nota deve ter no máximo 3000 caracteres',
            ]
        );

        // verifica se note id existe

        if (! $request->input('note_id')) {
            return redirect()->route('main');
        }

        // decrypt note_id

        $id = Operations::decrypt($request->input('note_id'));

        // carregar a nota

        $note = Note::find($id);

        // atualizar a nota

        $note->title = $request->input('text_title');
        $note->text = $request->input('text_note');
        $note->save();

        // redirecionar para a home

        return redirect()->route('main');
    }
}
