<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Operations
{
    public static function decrypt($value)
    {
        // verifica se deu certo decrypt, se não retorna a página inicial

        try {
            $value = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            return redirect()->route('main');
        }

        return $value;

    }
}
