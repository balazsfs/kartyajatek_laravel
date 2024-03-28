<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny',Place::class);

        $places = Place::get();
        return view("places.index",['places' => $places]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create',Place::class);
        return view("places.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create',Place::class);

        $validated = $request -> validate(
            [
                'name' => 'required|min:3',
                'file_path' => 'required|image'
            ],
            [
                'name.required' => 'Nem adtad meg a helyszín nevét!',
                'name.min' => 'A helyszín nevének legalább :min karakternek kell lennie!',
                'file_path.required' => 'Nem adtál meg képet!',
                'file_path.image' => 'Nem képet válaszottál ki!'
            ]
        );

        if($request->hasfile('file_path')){
            $file = $request ->file('file_path');
            $fname = $file -> hashName();
            Storage::disk('public')->put('images/'.$fname,$file->get());
            $validated['file_path'] = $fname;
        }

        Place::create($validated);
        return redirect()->route('places.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        Gate::authorize('create',Place::class);
        return view("places.edit",['place' => $place]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        Gate::authorize('update',$place,User::class);

        $validated = $request -> validate(
            [
                'name' => 'required|min:3',
                'file_path' => 'image'
            ],
            [
                'name.required' => 'Nem adtad meg a helyszín nevét!',
                'name.min' => 'A helyszín nevének legalább :min karakternek kell lennie!',
                'file_path.image' => 'Nem képet válaszottál ki!'
            ]
        );

        if($request->hasfile('file_path')){
            $file = $request ->file('file_path');
            $fname = $file -> hashName();
            Storage::disk('public')->put('images/'.$fname,$file->get());
            $validated['file_path'] = $fname;
        }

        $place ->update($validated);
        return redirect()->route('places.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        Gate::authorize('delete',$place,User::class);
        $place ->delete();
        return redirect() -> route('places.index');
    }
}
