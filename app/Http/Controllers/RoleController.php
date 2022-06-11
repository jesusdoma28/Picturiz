<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Devuelve el usuario autenticado
     *
     * @return \Illuminate\Http\Response
     */
    public function getAuthUserRole()
    {
        $userAuthRole = Auth::user()->role;

        return new Response($userAuthRole, 200);
    }
}
