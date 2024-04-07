@extends('layouts.main')

@section('content')
    <div class="h-screen">
        <div class="mx-auto p-6">
            <p class="mb-4 text-xl">
                Ez a feladat egy egyszerűsített, egyjátékos módban játszható, körökre osztott harcolós játék fejlesztését célozza meg a Laravel keretrendszer segítségével. A játék lényege, hogy a felhasználó karaktereket hoz létre, harcol velük ellenfelek ellen, és részt vesz mérkőzéseken különböző helyszíneken.
            </p>
            <p class="mb-4 text-xl">
                A játékban a felhasználók karaktereket hozhatnak létre, amelyek rendelkeznek védekező, támadó, pontosság és mágikus képességekkel. Ezeket a képességeket ügyesen kell kombinálni a harc során, hogy győzedelmeskedjenek az ellenfelek felett.
            </p>
            <p class="mb-4 text-xl">
                A felhasználók részt vehetnek mérkőzéseken, ahol a karaktereik összemérhetik erejüket más karakterekkel. A mérkőzések során a helyszínek kiválasztása és az ellenfelek megküzdése kulcsfontosságú a győzelem eléréséhez.
            </p>
            <p class="mb-4 text-xl">
                A játék folyamatos fejlesztést és stratégiai gondolkodást igényel a karakterek készségeinek optimalizálása és a harcok megnyerése érdekében. A felhasználók képesek saját karaktereiket létrehozni, módosítani és törölni, valamint új mérkőzéseket kezdeményezni a játék különböző részein.
            </p>
            <p class="mb-4 text-xl" >
                Összességében a játék egy izgalmas és kihívást jelentő környezetet kínál a játékosoknak, ahol stratégiai döntéseik és taktikai választásaik alapján vívhatnak csatákat az ellenségekkel szemben.
            </p>
            <div class="mt-6 text-xl text-center">
                <p>Eddigi létrehozott karakterek száma: {{$character_count}}</p>
                <p>Eddigi megtörtént mérkőzések száma: {{$game_count}}</p>
            </div>
        </div>
    </div>
@endsection
