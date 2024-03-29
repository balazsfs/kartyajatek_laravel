@extends('layouts.main')

@section('content')
    <div class="grid gap-4 xl:grid-cols-5 grid-rows-3 p-5 lg:grid-cols-4 sm:grid-cols-2">
        @forelse ($places as $place)
            <div class="bg-yellow-100 p-2 m-2 border-2 border-yellow-800 rounded">
                <div class="flex justify-center">
                    <img class="size-48" src="{{Storage::url('images/'.$place->file_path)}}" alt="">
                </div>
                <p class="text-center"><b>Helyszín: </b>{{$place->name}}</p>
                <div class="grid grid-cols-2">
                    @can('update',$place)
                        <div class="p-2 text-end">
                            <a class="bg-green-500 rounded p-1 border border-black" href="{{route('places.edit',['place'=>$place])}}">Szerkesztés</a>
                        </div>
                    @endcan

                    @can('delete',$place)
                        <form action="{{ route('places.destroy', ['place' => $place ])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-2 text-center">
                                <a class="bg-red-500 rounded p-1 border border-black text-white pr-4 pl-4" href="#" onclick="this.closest('form').submit()">Törlés</a>
                            </div>
                        </form>
                    @endcan
                </div>

            </div>
        @empty
            <p>Ninencsen helyszínek!</p>
        @endforelse
    </div>
@endsection
