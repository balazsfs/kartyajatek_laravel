@extends('layouts.main')

@section('title')
{{Auth::user()->name }} | Hely létrehozása
@endsection

@section('content')
<div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
    <form action="{{route('places.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2">
            <b class="mt-5 mb-5">
                Helyszín neve:
            </b>

            <div class="mt-5 mb-5">
                <input class="rounded-xl" type="text" name="name" value="{{old('name','')}}">
                @error('name')
                    <br><span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <b class="mt-5 mb-5">
                Helyszín képe:
            </b>

            <div class="mt-5 mb-5">
                <input type="file" name="file_path" value="{{old('file_path','')}}">
                @error('file_path')
                <br> <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="text-center">
            <button class="bg-green-500 rounded pl-5 pr-5 pb-3 pt-3 m-5 border border-black" type="submit">Mentés</button>
        </div>
    </form>
</div>
@endsection
