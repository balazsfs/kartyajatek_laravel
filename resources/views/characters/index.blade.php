@extends('layouts.main')

@section('content')
    <div class="grid gap-4 grid-cols-6 grid-rows-3 p-5">
        @forelse ($characters as $ch)
            <div class="bg-green-500 p-1 m-1 rounded-lg">
                <div class="text-center">
                    <b>{{ $ch -> name}}</b>
                </div>
                <div class="text-center">
                    <p>Strength: {{ $ch -> strength}}</p>
                    <p>Defence: {{ $ch -> defence}}</p>
                    <p>Magic: {{ $ch -> magic}}</p>
                    <p>Accuracy: {{ $ch -> accuracy}}</p>
                </div>
                <a href="{{route('characters.show',['character'=>$ch])}}">Bővebben</a>
            </div>
        @empty
            <p>Ninencsen karaktereid!</p>
        @endforelse
    </div>
@endsection
