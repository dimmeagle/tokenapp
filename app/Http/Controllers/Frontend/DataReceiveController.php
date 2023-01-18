<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\RecordRequest;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class DataReceiveController extends Controller
{
    public function index (Request $request)
    {
        return view('frontend/form');
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
