<?php

namespace App\Http\Controllers\Console;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static function create($username, $password)
    {
        $user = new User();
        $user->password = Hash::make($password);
        $user->email = $username;
        $user->name = $username;
        $user->username = $username;
        $user->save();

        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public static function getUserToken (int $id)
    {
        $token_data = DB::table('personal_access_tokens')
            ->where('tokenable_id', '=', $id)
            ->where('expires_at', '>=', now())
            ->first();

        return $token_data->token;
    }

    public static function checkUser (string $username, string $password)
    {
        $loginUser = Auth::attempt(['username' => $username, 'password' => $password]);
        if (!$loginUser) {
            $userExists = DB::table('users')
                ->where('username','=', $username)
                ->first();
            if (!empty($userExists)) {
                $response = 1;
            } else {
                $response = 0;
            }
        } else {
            $response = 2;
        }
        return $response;
    }
}
