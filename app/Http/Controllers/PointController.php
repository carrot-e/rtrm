<?php

namespace App\Http\Controllers;

use App\Point;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mockery\CountValidator\Exception;

class PointController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id) {
            $point = Point::find($request->id);
            if ($point->map->user_id !== Auth::user()->id) {
                return redirect('/');
            }
        } else {
            $point = new Point;
        }

        if (Input::has('coordinates')) {
            $point->coordinates = $request->coordinates;
        }

        if (Input::has('description')) {
            $point->description = $request->description;
        }

        if (Input::has('order')) {
            $point->order = $request->order;
        }

        if (Input::has('mapId')) {
            $point->map_id = $request->mapId;
        }

        $point->save();

        return Response::create($point->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $point = Point::find($id);
        if ($point->map->user_id !== Auth::user()->id) {
            return redirect('/');
        }

        if (!empty($point)) {
            $point->delete();
            return Response::create('OK');
        } else {
            return Response::create('Fail', 500);
        }
    }
}
