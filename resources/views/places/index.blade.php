@extends('layouts.main')

@section('content')
    <div class="grid gap-4 grid-cols-6 grid-rows-3 p-5">
        @forelse ($places as $place)
            <div class="bg-green-500 p-1 m-1 rounded-lg">
                {{$place->name}}
                {{$place->file_path}}

            @can('update',$place)
                <a href="{{route('places.edit',['place'=>$place])}}">Szerkesztés</a>
            @endcan

            @can('delete',$place)
                <form action="{{ route('places.destroy', ['place' => $place ])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="#" onclick="this.closest('form').submit()">Törlés</a>
                </form>
            @endcan
            </div>
        @empty
            <p>Ninencsen helyszínek!</p>
        @endforelse
    </div>
@endsection
