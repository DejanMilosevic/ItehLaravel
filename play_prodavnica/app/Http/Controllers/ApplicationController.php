<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Application::all();
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'number_of_downloads' => 'required|integer',
            'release_date' => 'required|date|before:now'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $application = Application::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'number_of_downloads' => $request->number_of_downloads,
            'release_date' => $request->release_date
        ]);

        return response()->json(['message' => 'Aplikacija je uspesno kreirana.', 'application' => $application]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Application::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'number_of_downloads' => 'required|integer',
            'release_date' => 'required|date|before:now'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $application = Application::find($id);

        $application -> update([
            'name' => $request->name,
            'description' => $request->description,
            'number_of_downloads' => $request->number_of_downloads,
            'release_date' => $request->release_date
        ]);

        return response()->json(['message' => 'Aplikacija je uspesno azurirana.', 'application' => $application]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::find($id);

        if(is_null($application)){
            return response()->json(['message' => 'Aplikacija nije pronadjena.'],404);
        }

        $application->delete();

        return response()->json(['message' => 'Aplikacija je uspesno obrisana.']);
    }
}
