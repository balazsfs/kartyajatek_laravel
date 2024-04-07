@extends('layouts.main')

@section('content')
    <b>Helyszín: </b>{{ $game->place()->get('name')->pluck('name')->implode(', ')}}</br>
    <b>Előzmények: </b> {{$game->history}}
    <div class="grid gap-4 grid-cols-2 p-5">
        @foreach ($game->characters()->get() as $character )
            <div class="bg-yellow-100 p-1 m-1 border-4 border-yellow-800 rounded">
                <div class="flex justify-center">
                    @if ($character -> enemy)
                    <img src="{{Storage::url('images/enemy.png')}}" alt="">
                    @else
                        <img src="{{Storage::url('images/gladiator.png')}}" alt="">
                    @endif
                </div>
                <div class="text-center">
                    <b>{{ $character -> name}}</b>
                </div>
                <div class="text-center">
                    <p>Erő: {{ $character -> strength}}</p>
                    <p>Ügyesség: {{ $character -> accuracy}}</p>
                    <p>Intelligencia: {{ $character -> magic}}</p>
                    <p>Védelem: {{ $character -> defence}}</p>
                    @if($character->enemy)
                        <p>Hp: {{$character->pivot->enemy_hp}}</p>
                    @else
                        <p>Hp: {{$character->pivot->hero_hp}}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="grid gap-4 grid-cols-3 p-5 text-center">
        @if($game->win == null)
            <form action="{{ route('games.attack', ['game' => $game])}}" method="POST">
                @csrf
                <input type="hidden" name="attackType" value="melee">
                <a class="bg-red-600 rounded-xl pr-8 pl-8 pt-5 pb-5 text-xl" href="#" onclick="this.closest('form').submit()">Kard</a>
            </form>
            <form action="{{ route('games.attack', ['game' => $game])}}" method="POST">
                @csrf
                <input type="hidden" name="attackType" value="ranged">
                <a class="bg-yellow-500 rounded-xl pr-8 pl-8 pt-5 pb-5 text-xl" href="#" onclick="this.closest('form').submit()">Nyíl</a>
            </form>
            <form action="{{ route('games.attack', ['game' => $game])}}" method="POST">
                @csrf
                <input type="hidden" name="attackType" value="special">
                <a class="bg-cyan-500 rounded-xl pr-8 pl-8 pt-5 pb-5 text-xl" href="#" onclick="this.closest('form').submit()">Varázslat</a>
            </form>
        @elseif(!$game->win)
            Veszítettél
        @elseif($game->win)
            Nyertél
        @endif
    </div>
@endsection
