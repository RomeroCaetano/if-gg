<?php

namespace App\Http\Controllers;

use App\Match;
use App\Services\LolRequestService;
use Illuminate\Http\Request;

class MatchsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $match = Match::where('participants.summonerId','LIKE','t1zgW2FvDn95vE8C5w7HsVysqNUFAYTHzPypzLtZLXs1SA')->join('match_details','matches.gameId','=','match_details.gameId')->join('participants','participants.match_detail_id','=','match_details.gameId')->orderBy('gameCreation','desc')->paginate(10);

        $version = (new LolRequestService(true))->getLastVersion();

        $name = 'Lanolder';

        return view('matchs.index', compact(['match', 'version', 'name']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        //
    }
}
