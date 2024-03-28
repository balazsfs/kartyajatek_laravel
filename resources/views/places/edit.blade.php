@extends('layouts.main')

@section('content')
    <form action="{{route('places.update',['place'=>$place])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        Helyszín neve:
        <input type="text" name="name" value="{{old('name',$place->name)}}"><br>
        @error('name')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror

        Helyszín képe:
        <input type="file" name="file_path" value="{{old('file_path','')}}"><br>
        @error('file_path')
            <span class="text-red-500">{{ $message }}</span><br>
        @enderror
        <button class="bg-green-500 hover:bg-green-700" type="submit">Mentés</button>
    </form>
@endsection
