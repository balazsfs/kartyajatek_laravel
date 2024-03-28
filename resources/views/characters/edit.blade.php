@extends('layouts.main')

@section('content')
    <form action="{{route('characters.update',['character'=>$character])}}" method="POST">
        @csrf
        @method('PATCH')

        Karakter név:
        <input type="text" name="name" value="{{old('name',$character->name)}}"><br>
        @error('name')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror

        Erő:
        <input type="text" name="strength" value="{{old('strength',$character->strength)}}"><br>
        @error('strength')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror

        Védelem:
        <input type="text" name="defence" value="{{old('defence',$character->defence)}}"><br>
        @error('defence')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror

        Ügyesség:
        <input type="text" name="accuracy" value="{{old('accuracy',$character->accuracy)}}"><br>
        @error('accuracy')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror

        Intelligencia:
        <input type="text" name="magic" value="{{old('magic',$character->magic)}}"><br>
        @error('magic')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror

        @if(auth()->user()->admin())
            <input type="checkbox" name="enemy" value='1'>
        @endif

        @error('attributes')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror
        <button class="bg-green-500 hover:bg-green-700" type="submit">Mentés</button>
    </form>
@endsection
