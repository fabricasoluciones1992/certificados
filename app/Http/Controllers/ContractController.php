<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Post;
use App\Models\TypeContracts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractController extends Controller
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
        $contracts = Contract::all();
        return view('contratos.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contracts = Contract::all();
        $typeContracts = TypeContracts::all();
        $users = User::all();
        $posts = Post::all();
        return view('contratos.create', compact('contracts','typeContracts','users','posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contracts = new Contract();
        $contracts->id_users = $request->id_users;
        $contracts->start = $request->start;
        $contracts->end = $request->end;
        $contracts->salary = $request->salary;
        $contracts->id_posts = $request->id_posts;
        $contracts->id_type_contracts = $request->id_type_contracts;
        $contracts->status = 1;
        $contracts->save();
        return redirect(route('contracts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $contracts = Contract::find($id);
        // return view('contratos.show', compact('contracts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contracts = Contract::find($id);
        $users = User::find($contracts->id_users);
        $posts = Post::all();
        $typeContracts = TypeContracts::all();
        return view('contratos.edit', compact('contracts','users','posts','typeContracts'));
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

        $contracts = Contract::find($id);
        $contracts->start = $request->start;
        $contracts->end = $request->end;
        $contracts->salary = $request->salary;
        $contracts->id_posts = $request->id_posts;
        $contracts->id_type_contracts = $request->id_type_contracts;
        $contracts->status = 1;
        $contracts->save();
        return redirect(route('contracts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contracts = Contract::find($id);
        $contracts->end = Carbon::now();
        $contracts->status = 2;
        $contracts->save();
        return redirect(route('contracts.index'));
    }
}
