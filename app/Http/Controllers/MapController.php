<?php

namespace App\Http\Controllers;

use App\Map;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function test()
    {
        dd(\App\Point::find(98)->map->user);
        die;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id) {
            $map = Map::find($request->id);
            if ($map->user_id !== Auth::user()->id) {
                return redirect('/');
            }
        } else {
            $map = new Map;
            $map->user_id = Auth::user()->id;
        }
        $center = $request->center['lat'] . ',' . $request->center['lng'];

        $map->zoom = $request->zoom;
        $map->description = $request->description;
        $map->title = $request->title;
        $map->center = $center;

        $map->save();

        return Response::create($map->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $map = Map::find($id);
        $map->user = $map->user;
        return Response::create(json_encode($map));
    }


    public function getPoints($id)
    {
        $points = Map::find($id)->points()->orderBy('created_at')->get();
        return Response::create(json_encode($points));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
