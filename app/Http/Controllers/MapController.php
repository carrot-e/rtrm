<?php

namespace App\Http\Controllers;

use App\Map;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
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
        return Map::with('user')->orderBy('created_at')
                                ->where(['is_public' => 1])
                                ->limit(50)
                                ->get();
    }

    public function getUserMaps($userId)
    {
        $maps = Map::with('user')->orderBy('created_at')->limit(50);
        if ($userId != Auth::user()->id) {
            $maps->where(['is_public' => 1, 'user_id' => $userId]);
        } else {
            $maps->where(['user_id' => $userId]);
        }

        return json_encode(['maps' => $maps->get(), 'author' => User::find($userId)]);
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
//        dd(Map::with('user')->get());
dd(        Map::with('user')->orderBy('created_at')->where(['is_public' => 1])->limit(50)->get()
    );
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
        if ($request->center !== null) {
            $center = $request->center['lat'] . ',' . $request->center['lng'];
            $map->center = $center;
        }
        if ($request->zoom !== null) {
            $map->zoom = $request->zoom;
        }
        if ($request->description !== null) {
            $map->description = $request->description;
        }
        if ($request->title !== null) {
            $map->title = $request->title;
        }
        if ($request->is_public !== null) {
            $map->is_public = $request->is_public;
        }
        if ($request->photo !== null) {
            $map->photo = $request->photo;
        }

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
