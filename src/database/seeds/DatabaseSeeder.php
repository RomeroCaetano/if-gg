<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(SummonerTableSeeder::class);
        $this->call(ChampionTableSeeder::class);
        // $this->call(MatchsTableSeeder::class);
        $this->call(ItensTableSeeder::class);
        $this->call(SummonerSpellsTableSeeder::class);
        // $this->call(MatchDetailTableSeeder::class);

    }
}
