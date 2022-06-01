<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Videogame;
use Illuminate\Http\Request;

class VideogameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Videogame::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'description'=>'required',
            'genres_id'=>'required',
            'platforms_id'=>'required',
            'price'=>'required',
        ]);
        $request->user()->videogames()->create($request->all());

        return response('Game added succesfully',201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Videogame::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $game = Videogame::find($id);
        if ($game==null)
        {
            return response("videogame not found",200);
        }
        $game->update($request->all());
        return $game;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        /* $this->authorize('delete',$videogame); */
        $game = Videogame::find($id);
        if ($game==null)
        {
            return response("videogame not found",200);
        }
        
        $game->delete();
        return response ("videogame deleted",200);
    }

    /**
     * Search for a name
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($title)
    {
        return Videogame::where('title', 'like', '%'.$title.'%')->get();
    }
}
