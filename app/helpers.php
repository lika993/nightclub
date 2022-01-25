<?php

use App\Dance;

function getDanceImage($gender, $genre)
{
    $images = array_diff(scandir(public_path() . "/images/$genre/$gender"), array('..', '.'));
    $randKey = array_rand($images);
    return "/images/$genre/$gender/$images[$randKey]";
}

function getDrinkersImage($gender)
{
    $images = array_diff(scandir(public_path() . "/images/vodka/$gender"), array('..', '.'));
    $randKey = array_rand($images);
    return "/images/vodka/$gender/$images[$randKey]";
}

function getDanceMovements($genre) {
    $danceSkill = json_decode(Dance::where('name', $genre)->get("movements")->first()['movements'], JSON_PRETTY_PRINT);
    $dance = [];
    foreach ($danceSkill as $bodyPart => $danceSkillData) {
        $rand_key = array_rand($danceSkillData);
        trans("body_parts.$bodyPart");
        $movement = $danceSkillData[$rand_key];
        !empty($movement) ? array_push($dance, "<b>" . trans("body_parts.$bodyPart") . "</b>" . ": $movement") : '';
    }
    return $dance;
}

function getTime($duration) {
    return gmdate('H:i:s', $duration);
}
