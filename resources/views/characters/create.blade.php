@extends('layouts.main')

@section('content')
    <form action="{{route('characters.store')}}" method="POST">
        @csrf
        Karakter név:
        <input type="text" name="name" value="{{old('name','')}}"><br>
        @error('name')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror

        Erő:
        <input type="text" name="strength" value="{{old('strength','')}}"><br>
        @error('strength')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror

        Védelem:
        <input type="text" name="defence" value="{{old('defence','')}}"><br>
        @error('defence')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror

        Ügyesség:
        <input type="text" name="accuracy" value="{{old('accuracy','')}}"><br>
        @error('accuracy')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror

        Intelligencia:
        <input type="text" name="magic" value="{{old('magic','')}}"><br>
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
