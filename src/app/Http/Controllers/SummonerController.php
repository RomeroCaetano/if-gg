<?php

namespace App\Http\Controllers;

use App\Summoner;
use Illuminate\Http\Request;

class SummonerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $summoner = Summoner::all();
        return view('summoners.index', compact('summoner'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $name = str_replace(' ','%20',$_GET['name']);

        $opts = array('https' =>
            array(
                'method'  => 'GET',
                'header'  => array(
                    "Origin" => "https://developer.riotgames.com",
                    "Accept-Charset" => "application/x-www-form-urlencoded; charset=UTF-8",
                    "X-Riot-Token" => "RGAPI-b10ab7a0-eeac-409c-9a36-ed59b9cd817b",
                    "Accept-Language" => "pt-BR,pt;q=0.8,en-US;q=0.5,en;q=0.3",
                    "User-Agent" => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:71.0) Gecko/20100101 Firefox/71.0")
            )
        );
        
        $context = stream_context_create($opts);
        
        $result = file_get_contents("https://br1.api.riotgames.com/lol/summoner/v4/summoners/by-name/".$name."?api_key=RGAPI-5b59cc6f-93d2-4f13-a97c-a57e4d94e771", false, $context);
        
        $responseData = json_decode($result, true);

        return view('summoners.create', [ 
            'name' => $responseData['name'],
            'puuid' => $responseData['puuid'], 
            'summonerLevel' => $responseData['summonerLevel'], 
            'revisionDate' => $responseData['revisionDate'], 
            'idapi' => $responseData['id'], 
            'accountId' => $responseData['accountId'], 
            'profileIconId' => $responseData['profileIconId']
        ] );
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
        $dadosCorretos = array(
            'name' => $request['name'], 
            'puuid' => $request['puuid'], 
            'summonerLevel' => $request['summonerLevel'], 
            'revisionDate' => $request['revisionDate'], 
            'idapi' => $request['idapi'], 
            'accountId' => $request['accountId'], 
            'profileIconId' => $request['profileIconId']
        );
        Summoner::create($dadosCorretos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Summoner  $summoner
     * @return \Illuminate\Http\Response
     */
    public function show(Summoner $summoner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Summoner  $summoner
     * @return \Illuminate\Http\Response
     */
    public function edit(Summoner $summoner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Summoner  $summoner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Summoner $summoner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Summoner  $summoner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Summoner $summoner)
    {
        $summoner = Summoner::findOrFail($summoner->id);
        $summoner->delete();

        return redirect(route('summoner.index'))->with('success', 'summoner is successfully deleted');
    }
}
