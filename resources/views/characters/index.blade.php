@extends('layouts.main')

@section('content')
    <div class="grid gap-4 grid-cols-6 grid-rows-3">
        @forelse ($characters as $ch)
            <div class="bg-yellow-100 p-1 m-1 border-4 border-yellow-800 rounded">
                <div class="flex justify-center">
                    @if ($ch -> enemy)
                    <img src="{{Storage::url('images/enemy.png')}}" alt="">
                    @else
                        <img src="{{Storage::url('images/gladiator.png')}}" alt="">
                    @endif
                </div>
                <div class="text-center">
                    <b>{{ $ch -> name}}</b>
                </div>
                <div class="text-center">
                    <p>Erő: {{ $ch -> strength}}</p>
                    <p>Ügyesség: {{ $ch -> accuracy}}</p>
                    <p>Intelligencia: {{ $ch -> magic}}</p>
                    <p>Védelem: {{ $ch -> defence}}</p>
                </div>
                <div class="p-2 text-center">
                    <a class="bg-amber-300 rounded p-1 border border-yellow-800" href="{{route('characters.show',['character'=>$ch])}}">Bővebben</a>
                </div>

            </div>
        @empty
            <p>Ninencsen karaktereid!</p>
        @endforelse
    </div>
@endsection
