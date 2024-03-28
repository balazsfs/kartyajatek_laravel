@extends('layouts.main')

@section('content')
    <div class="bg-green-500 text-center">
        <b>{{ $character -> name }}</b>
        <div class="">
            <div class="text-center">
                <p>Strength: {{ $character -> strength}}</p>
                <p>Defence: {{ $character -> defence}}</p>
                <p>Magic: {{ $character -> magic}}</p>
                <p>Accuracy: {{ $character -> accuracy}}</p>
            </div>
            <b>Meccsek:</b><br>
            @forelse ($character ->games() ->get() as $game)
                <b>Helyszín: </b>{{$game->place()->get(['name'])->pluck('name')->implode(', ')}}
                @foreach ($game->characters()->get() as $ch)
                    @if($ch->name != $character->name)
                        <b>Ellenfél: </b>{{$ch->name}}
                    @endif
                @endforeach
                <br>
            @empty
                Még nem volt meccse ennek a karakternek
            @endforelse
        </div>
        <a href="{{route('characters.edit',['character'=>$character])}}">Szerkesztés</a>
    </div>
@endsection
