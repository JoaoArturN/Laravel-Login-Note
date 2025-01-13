<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        session()->forget('user');

        return redirect()->route('login');
    }

    public function loginsubmit(Request $request)
    {

        $request->validate(
            [
                'text_username' => 'required',
                'text_password' => 'required|min:3|max:16',
            ],

            // error messages
            [
                'text_username.required' => 'O campo de usuário é obrigatório',
                'text_password.required' => 'O campo de senha é obrigatório',
                'text_password.min' => 'A senha deve ter no mínimo 3 caracteres',
                'text_password.max' => 'A senha deve ter no máximo 16 caracteres',
            ],

        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // / código que verifica se o usuário existe
        $user = User::where('username', $username)->
        where('deleted_at', null)->first();

        // retornar erro

        if (! $user) {
            return redirect()->back()->with('loginError', 'Usuário ou senha incorretos');
        }

        // verificar se a senha está correta

        if (! password_verify($password, $user->password)) {

            return redirect()->back()->with('loginError', 'Usuário ou senha incorretos');
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        // realizar login

        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
                'last_login' => $user->last_login,
            ],
        ]);

        // ir para página principal

        return redirect(
            route('main')
        );

    }
}
