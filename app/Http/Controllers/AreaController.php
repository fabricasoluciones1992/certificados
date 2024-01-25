<?php

namespace App\Http\Controllers;

use App\Models\Area;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        $areas = Area::all();
        $user = Auth::user();
        if ($user->id_roles != 2) {
            return redirect(route('users.index'));
        }else{
            return view('areas.index', compact('areas'));
        }
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $area = Area::create($request->all());
        return redirect(route('areas.index'));
    }

    public function show($post)
    {
        $area = Area::find($post);
        return view('areas.show', compact('area'));
    }

    public function edit($post)
    {
        $area = Area::find($post);
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, $post)
    {
        $area = Area::find($post);
        $area->name = $request->name;
        $area->save();
        return redirect(route('areas.index'));
    }

}
