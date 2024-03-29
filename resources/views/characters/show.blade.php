@extends('layouts.main')

@section('content')
    <div class="grid gap-4 grid-cols-3">
        <div>
            @can('update',$character)
            <div class="p-4 text-center">
                <a class="bg-green-500 rounded p-3 border border-black" href="{{route('characters.edit',['character'=>$character])}}">Szerkesztés</a>
            </div>
             @endcan

            @can('delete',$character)
                <form action="{{ route('characters.destroy', ['character' => $character ])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="p-4 text-center">
                        <a class="bg-red-600 text-white rounded p-3 border border-black" href="#" onclick="this.closest('form').submit()">Törlés</a>
                    </div>
                </form>

            @endcan
            @if (!$character->enemy)
                <form action="{{ route('games.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="character_id" value="{{$character->id}}">
                    <div class="p-4 text-center">
                        <a class="bg-green-500 rounded p-3 border border-black" href="#" onclick="this.closest('form').submit()">Új meccs</a>
                    </div>
                </form>
            @endif
        </div>
        <div class="flex justify-end">
            @if ($character -> enemy)
            <img src="{{Storage::url('images/enemy.png')}}" alt="">
            @else
                <img src="{{Storage::url('images/gladiator.png')}}" alt="">
            @endif
        </div>
        <div class="">
            Név: <b>{{ $character -> name}}</b>
            <p>Erő: {{ $character -> strength}}</p>
            <p>Ügyesség: {{ $character -> accuracy}}</p>
            <p>Intelligencia: {{ $character -> magic}}</p>
            <p>Védelem: {{ $character -> defence}}</p>
        </div>
    </div>
    <div class="">
        <b>Meccsek:</b><br>
            <div class="grid gap-4 grid-cols-4">
            @forelse ($character ->games() ->get() as $game)
                <div class="bg-yellow-100 p-2 m-2 border-2 border-yellow-800 rounded">
                    <div class="flex justify-center">
                        <img class="size-48" src="{{Storage::url('images/'.$game->place()->get(['file_path'])->pluck('file_path')->implode(', '))}}" alt="">
                    </div>
                    <p class="text-center"><b>Helyszín: </b>{{$game->place()->get(['name'])->pluck('name')->implode(', ')}}</p>
                    @foreach ($game->characters()->get() as $ch)
                        @if($ch->name != $character->name)
                            <p class="text-center"><b>Ellenfél: </b>{{$ch->name}}</p>
                        @endif
                    @endforeach
                    <div class="p-2 text-center">
                        <a class="bg-amber-300 rounded p-1 border border-yellow-800" href="{{route('games.show',['game'=>$game])}}">Bővebben</a>
                    </div>
                </div>

            @empty
                Még nem volt meccse ennek a karakternek
            @endforelse
            </div>
        </div>
    </div>
@endsection
