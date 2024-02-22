<?php

namespace App\Http\Controllers;

use App\Models\PlayerResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $results = PlayerResult::where('player_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('game', compact('results'));
    }

    public function result(Request $request)
    {
        $playerId = $request->input('player_id');
        $result = $request->input('result');

        $playerResult = new PlayerResult();
        $playerResult->player_id = $playerId;
        $playerResult->result = $result;
        $playerResult->save();

        return redirect()->route('game');
    }
}
