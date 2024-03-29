@extends('layouts.main')

@section('content')
    <b>Helyszín: </b>{{ $game->place()->get('name')->pluck('name')->implode(', ')}}</br>
    <b>Előzmények: </b> {{$game->history}}
    @push('styles')
    <style>
        body {
            background-image: url({{Storage::url("images/".$game->place()->get('file_path')->pluck('file_path')->implode(', ')) }});
        }
    </style>
    @endpush
    <div class="grid gap-4 grid-cols-2 grid-rows-3 p-5">
    @foreach ($game->characters()->get() as $character )
        <div class="bg-green-500 text-center">
            <b>{{ $character -> name }}</b>
            <div class="">
                <p>Strength: {{ $character -> strength}}</p>
                <p>Defence: {{ $character -> defence}}</p>
                <p>Magic: {{ $character -> magic}}</p>
                <p>Accuracy: {{ $character -> accuracy}}</p>
                @if($character->enemy)
                    <p>Hp: {{$character->pivot->enemy_hp}}</p>
                @else
                    <p>Hp: {{$character->pivot->hero_hp}}</p>
                @endif
            </div>
        </div>
    @endforeach

    @if($game->win == null)
        <form action="{{ route('games.attack', ['game' => $game])}}" method="POST">
            @csrf
            <input type="hidden" name="attackType" value="melee">
            <a href="#" onclick="this.closest('form').submit()">Melee</a>
        </form>
        <form action="{{ route('games.attack', ['game' => $game])}}" method="POST">
            @csrf
            <input type="hidden" name="attackType" value="ranged">
            <a href="#" onclick="this.closest('form').submit()">Ranged</a>
        </form>
        <form action="{{ route('games.attack', ['game' => $game])}}" method="POST">
            @csrf
            <input type="hidden" name="attackType" value="special">
            <a href="#" onclick="this.closest('form').submit()">Special</a>
        </form>
    @elseif(!$game->win)
        Veszítettél
    @elseif($game->win)
        Nyertél
    @endif
    </div>
@endsection
