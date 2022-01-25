<?php

namespace App\Http\Controllers;

use App\Support_message;
use App\Track;
use GuestsTableSeeder;
use App\Dance;
use App\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->test = Dance::all();
        $this->tracks = Track::all();
        $this->guests = Guest::all();

        $this->danceList = [];
        $this->drinkingList = [];
    }



    public function categorizeGuests($genre) {
        foreach ($this->guests as $guest) {
            if(in_array($genre, json_decode($guest['skills']))) {
                $guest['movements'] = getDanceMovements($genre);
                $guest['currentDanceImage'] = getDanceImage($guest['gender'], $genre);
                $this->danceList[] = $guest;
            } else {
                $guest['currentDanceImage'] = getDrinkersImage($guest['gender']);
                $this->drinkingList[] = $guest;
            }
        }
    }

    public function getTrack($trackId = null) {
        return !(empty($trackId)) ? $this->tracks->where('id', $trackId)->first() :  $this->tracks->random();
    }

    public function getDanceFloorInfo(Request $request) {
        $validatorNotFound =  Validator::make($request->all(), [
            'trackId' => 'exists:tracks,id|numeric',
        ]);
        if ($validatorNotFound->fails()) {

            return response()->json(['status' => 'error','errors' => $validatorNotFound->errors()], 404);
        }
        $currentTrack = $this->getTrack($request->trackId);
        $currentGenre = $currentTrack['genre'];
        $this->categorizeGuests($currentGenre);
        $danceList = array_reverse($this->danceList);
        $drinkingList = array_reverse($this->drinkingList);
        $dances = Dance::all();
        $status = 'success';
        return response(compact(
            'status', 'currentTrack', 'danceList', 'drinkingList', 'dances'
        ));
    }

    public function generateUsers() {
        \Artisan::call('db:seed', [
            '--class' => 'GuestsTableSeeder',
        ]);
        $status = 'success';
        return response(compact(
            'status'
        ));
    }

    public function index()
    {
        $currentTrack = $this->getTrack();
        $currentGenre = $currentTrack['genre'];
        $this->categorizeGuests($currentGenre);
        $danceList = $this->danceList;
        $drinkingList = $this->drinkingList;
        $dances = Dance::all();
        return view('welcome', compact('currentTrack', 'danceList', 'drinkingList', 'dances'));
    }
}
