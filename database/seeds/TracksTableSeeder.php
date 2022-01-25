<?php

use Illuminate\Database\Seeder;

class TracksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tracks = [
            ["name" =>  "Don't Let Me Be Misunderstood", "artist" => "Jac Ross", "genre" =>  "rnb", "duration" => 172],
            ["name" =>  "Geist", "artist" => "OVERWERK", "genre" =>  "electrodance", "duration" => 213],
            ["name" =>  "With Myself", "artist" => "Winona Oak", "genre" =>  "pop", "duration" => 202],
            ["name" =>  "Words Remain", "artist" => "Moderator, Josh Garrels", "genre" =>  "hiphop", "duration" => 207],
            ["name" =>  "Reality Cuts Me Like a Knife", "artist" => "Faada Freddy", "genre" =>  "rnb", "duration" => 174],
            ["name" =>  "Astronaut In The Ocean","artist" => "Masked Wolf", "genre" =>  "hiphop", "duration" => 132],
            ["name" =>  "American Funeral", "artist" => "Joseph Angel", "genre" =>  "rnb", "duration" => 215],
            ["name" =>  "Mil Pasos", "artist" => "Soha", "genre" =>  "rnb", "duration" => 246],
            ["name" => "Deep End", "artist" => "Deep End", "genre" =>  "rnb", "duration" => 141],
            ["name" =>  "Puppet Theatre", "artist" => "Claptone, Peter Bjorn & John", "genre" =>  "electrodance", "duration" => 214],
        ];
        foreach ($tracks as $track) {
            DB::table('tracks')->insert([
                'name' => $track['name'],
                'genre' => $track['genre'],
                'artist' => $track['artist'],
                'duration' => $track['duration'],
            ]);
        }
    }
}
