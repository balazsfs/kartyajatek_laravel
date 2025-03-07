@extends('layouts.main')

@section('title')
{{Auth::user()->name }} | Karakter létrezhozása
@endsection

@section('content')
<div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
<form action="{{route('characters.store')}}" method="POST">
        <div class="grid grid-cols-2">
        @csrf
        <b class="mt-2 mb-2">
            Karakter név:
        </b>

        <div class="mt-2 mb-2">
            <input class="rounded-xl" type="text" name="name" value="{{old('name','')}}">
            @error('name')
                <br><span class="text-red-600 font-bold">{{ $message }}</span>
            @enderror
        </div>


        <b class="mt-2 mb-2">
            Erő:
        </b>


        <div class="mt-2 mb-2">
            <input class="rounded-xl" type="text" name="strength" value="{{old('strength','')}}">
            @error('strength')
                <br><span class="text-red-600 font-bold">{{ $message }}</span>
            @enderror
        </div>

        <b class="mt-2 mb-2">
            Védelem:
        </b>

        <div class="mt-2 mb-2">
            <input class="rounded-xl" type="text" name="defence" value="{{old('defence','')}}">
            @error('defence')
                <br><span class="text-red-600 font-bold">{{ $message }}</span>
            @enderror
        </div>

        <b class="mt-2 mb-2">
            Ügyesség:
        </b>

        <div class="mt-2 mb-2">
            <input class="rounded-xl" type="text" name="accuracy" value="{{old('accuracy','')}}">
            @error('accuracy')
                <br><span class="text-red-600 font-bold">{{ $message }}</span>
            @enderror
        </div>

        <b class="mt-2 mb-2">
            Intelligencia:
        </b>

        <div class="mt-2 mb-2">
            <input class="rounded-xl" type="text" name="magic" value="{{old('magic','')}}">
            @error('magic')
                <br><span class="text-red-600 font-bold">{{ $message }}</span>
            @enderror
        </div>


        </div>

        @if(auth()->user()->admin())
        <div>
            <span>Ellenfél:</span>
            <input type="checkbox" name="enemy" value='1'>
        </div>
        @endif

        @error('attributes')
            <span class="text-red-600 font-bold">{{ $message }}</span>
        @enderror

        <div class="text-center">
            <button class="bg-green-500 rounded pl-5 pr-5 pb-3 pt-3 m-5 border border-black" type="submit">Mentés</button>
        </div>
    </form>
</div>
</div>
@endsection
