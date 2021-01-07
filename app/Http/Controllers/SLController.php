<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SLController extends Controller
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
        // if(auth()->user()->role !== 'IV') {
        //     return redirect('/')->with('error', 'Unauthorized page');
        // } 
        return view('SL.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'schakelbriefnr' => 'required' ,
        //     'windpark' => 'required',
        //     'date' => 'required'
        // ]);    

        // //create
        // $posts = new Posts;
        // $posts->title = $request->input('title');
        // $posts->body = $request->input('body');
        // $posts->type = $request->input('type');
        // if($request->input('story') != 'empty'){
        //     $posts->story = $request->input('story');
        // }
        // if($request->input('arc') != 'empty'){
        //     $posts->arc = $request->input('arc');
        // }
        // $posts->user_id = auth()->user()->id;      
        // $posts->user_role = auth()->user()->role;
        // $posts->cover_image = $fileNameToStore;
        // $posts->save();
        return view('SL.test');
        // return redirect('/')->with('success', 'Post Created');
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
        //
    }
}
