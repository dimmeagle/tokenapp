<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\RecordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Laravel\Sanctum\PersonalAccessToken;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        if (!empty($token))
        {
            $user = $token->tokenable;
        }
        if (!empty($request->bearerToken()) && !empty($user))
        {
            return view('frontend/form');
        } else {
            return abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        if (!empty($token))
        {
            $user = $token->tokenable;
        }
        if (!empty($request->bearerToken()) && !empty($user))
        {
            return view('frontend/form');
        } else {
            return abort(403);
        }
    }

    public function store(RecordRequest $request)
    {

        $id = Auth::id() ? Auth::id() : 1;

        DB::enableQueryLog();
        $id = DB::table('records')->insertGetId(
            [
                'request_data' => serialize($request->jsondata),
                'user_id' => $id,
                'created_at' => now(),
            ]
        );
        $mem = round(memory_get_usage() / 1024 / 1024, 2);
        $array = DB::getQueryLog();
        $data = end($array);
        DB::disableQueryLog();
        return Redirect::to('data')
            ->with('message', 'Data stored successfully!<br>Record ID: ' . $id .
                '<br>Request execution time: ' . $data['time'] . ' ms' .
                '<br>Memory spent: ' . $mem . ' Mb');
    }
}
