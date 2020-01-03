<?php

use Illuminate\Database\Seeder;
use App\MatchDetail;
use App\Match;
use App\Participants;
use App\Services\LolRequestService;
class MatchDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lolService = new LolRequestService();
        $matches = Match::all();
        
        foreach($matches as $mat)
        {
            $result = $lolService->getMatchDetail($mat->gameId);
        
            $responseData = json_decode($result, true);
            $detail = new MatchDetail;
            $detail->gameId = $responseData['gameId'];
            $detail->gameMode = $responseData['gameMode'];
            $detail->gameType = $responseData['gameType'];
            $detail->gameDuration = $responseData['gameDuration'];
            $detail->gameCreation = $responseData['gameCreation'];
            $detail->save();

            foreach($responseData['participants'] as $part)
            {
                $participant = new Participants;
                $participant->participantId = $part['participantId'];
                $participant->match_detail_id = $responseData['gameId'];
                $participant->spell1Id = $part['spell1Id'];
                $participant->lane = $part['timeline']['lane'];
                $participant->spell2Id = $part['spell2Id'];
                $participant->largestMultiKill = $part['stats']['largestMultiKill'];
                $participant->kills = $part['stats']['kills'];
                $participant->assists = $part['stats']['assists'];
                $participant->deaths = $part['stats']['deaths'];
                $participant->goldEarned = $part['stats']['goldEarned'];
                $participant->champLevel = $part['stats']['champLevel'];
                $participant->championId = $part['championId'];
                $participant->teamId = $part['teamId'];
                foreach($responseData['participantIdentities'] as $sumId)
                {
                    if($sumId['participantId'] == $part['participantId'])
                    {
                        $participant->summonerName = $sumId['player']['summonerName'];
                    }
                }
                $participant->win = $part['stats']['win'];
                $participant->item0 = $part['stats']['item0'];
                $participant->item1 = $part['stats']['item1'];
                $participant->item2 = $part['stats']['item2'];
                $participant->item3 = $part['stats']['item3'];
                $participant->item4 = $part['stats']['item4'];
                $participant->item5 = $part['stats']['item5'];
                $participant->item6 = $part['stats']['item6'];
                $participant->save();
            }
        }
        
    }
}