<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1 class="title--main">Добро пожаловать на танцпол</h1>
<h3 class="track-info">Играет музыка: "{{$currentTrack['name']}}", {{$currentTrack['artist']}}, {{$currentTrack['genre']}}. {{getTime($currentTrack['duration'])}}</h3>
<div class="area">
    <div class="dance-floor">
        <div class="area_background">
            <h3>Танцуют</h3>
            <div class="area__grid">
                @foreach($danceList as $guest)
                    <div class="area__grid-item guest" style="background-image: url({{getDanceImage($guest['gender'], $currentTrack['genre'])}})">
                        <div class="area__grid-title">
                            {{$guest['name']}}
                        </div>
                        @php

                            $movements = getDanceMovements($currentTrack['genre']);
                        @endphp
                        <div class="guest__movements">
                            <button class="guest__movements-btn">
                                Показать движения
                            </button>
                            <div class="guest__movements-list">
                                @foreach($movements as $movement)
                                    <div class="guest__movements-item">{!!$movement !!}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bar">
        <div class="area_background">
            <h3>Пьют водку</h3>
            <div class="area__grid">
                @foreach($drinkingList as $guest)
                    <div class="area__grid-item" style="background-image: url({{getDrinkersImage($guest['gender'])}})">
                        <div class="area__grid-title">
                            {{$guest['name']}}
                        </div>
                        {{--                              <img src="{{getDrinkersImage($guest['gender'])}}" alt="">--}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</body>
</html>
