<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny',Character::class);

        $user = Auth::user();
        $characters = Character::where('user_id', $user->id)->get();
        return view("characters.index", ['characters' => $characters]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create',Character::class);
        return view('characters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create',Character::class);

        $validated = $request->validate(
            [
                'name' => 'required|min:3',
                'enemy' => '',
                'defence' => 'required|numeric|min:0|max:20',
                'strength' => 'required|numeric|min:0|max:20',
                'accuracy' => 'required|numeric|min:0|max:20',
                'magic' => 'required|numeric|min:0|max:20'
            ],
            [
                'title.required' => 'Név megadás kötelező!',
                'title.min' => 'A névnek legalább :min kell lennie!',
                'defence.numeric' => 'Az attribútomnak számot kell megadnod!',
                'strength.numeric' => 'Az attribútomnak számot kell megadnod!',
                'accuracy.numeric' => 'Az attribútomnak számot kell megadnod!',
                'magic.numeric' => 'Az attribútomnak számot kell megadnod!',
                'defence.min' => 'Az attribútumoknak legalább 0-nak kell lennie!',
                'strength.min' => 'Az attribútumoknak legalább 0-nak kell lennie!',
                'accuracy.min' => 'Az attribútumoknak legalább 0-nak kell lennie!',
                'magic.min' => 'Az attribútumoknak legalább 0-nak kell lennie!',
                'defence.max' => 'Az attribútumoknak maximum 20-ig adhatsz meg értéket!',
                'strength.max' => 'Az attribútumoknak maximum 20-ig adhatsz meg értéket!',
                'accuracy.max' => 'Az attribútumoknak maximum 20-ig adhatsz meg értéket!',
                'magic.max' => 'Az attribútumoknak maximum 20-ig adhatsz meg értéket!',
            ]
        );
        $totalPoints = $validated['defence'] + $validated['strength'] + $validated['accuracy'] + $validated['magic'];
        if ($totalPoints !== 20) {
            return redirect()->back()->withErrors(['attributes' => 'Az attribútumok összegének 20-nak kell lennie!'])->withInput();
        }

        $validated['user_id'] = Auth::id();
        $character = Character::create($validated);
        return redirect() -> route('characters.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        Gate::authorize('view',$character,User::class);
        return view("characters.show", ['character' => $character, 'games' => $character->games()->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        //
    }
}
