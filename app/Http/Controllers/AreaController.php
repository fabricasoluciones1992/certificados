<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\People;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function __construct()
     {
         $this->middleware('auth');
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
        $user = Auth::user();
        $people = DB::table('people')->where('id_users','=',$user->id)->first();
        $people = People::find($people->id);
        if ($user->id_roles != 2) {
            return redirect(route('users.index'));
        }else{
            return view('areas.index', compact('people', 'areas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area = Area::create($request->all());
        return redirect(route('areas.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $area = Area::find($post);
        return view('areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        $area = Area::find($post);
        return view('areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $area = Area::find($post);
        $area->name = $request->name;
        $area->save();
        return redirect(route('areas.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $area = Area::find($post);
        $area->destroy($post);
        return redirect(route('areas.index'));
    }
}
