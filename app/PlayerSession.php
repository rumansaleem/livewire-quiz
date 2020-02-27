<?php

namespace App;

use Illuminate\Support\Facades\Session;

class PlayerSession
{
    public static function id($id = null)
    {
        if ($id === null) {
            return Session::get('active_quiz_session');
        }

        return Session::put('active_quiz_session', $id);
    }

    public static function nickname($nickname = null)
    {
        if ($nickname === null) {
            return Session::get('active_quiz_session_nickname');
        }

        return Session::put('active_quiz_session_nickname', $nickname);
    }
}
