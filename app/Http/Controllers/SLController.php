<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SL;
use App\Models\User;
use App\Models\Stappen;
use DB;

class SLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = auth()->user()->name;
        $switchbrief = SL::all();
        $iv = DB::select("SELECT * FROM switchbriefs WHERE ivname = '$name'");
        $wv = DB::select("SELECT * FROM switchbriefs WHERE mvname = '$name'");
        $pl = DB::select("SELECT * FROM switchbriefs WHERE plname = '$name'");
        // dd($switchbriefpl);
        return view('admin.switchbriefs.index')->with('switchbrief', $switchbrief)->with('iv', $iv)->with('wv', $wv)->with('pl', $pl);
        // return view('posts.index')->with('posts1', $posts1)->with('posts2', $posts2);
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
        // dd($request->input());
        $this->validate($request, [
            'windpark' => 'required',
            'date' => 'required',
            'ivname' => 'required' ,
            'ivtel' => 'required',
            'mvname' => 'required' ,
            'mvtel' => 'required',
            'plname' => 'required' ,
            'pltel' => 'required',
            'bedrijf' => 'required' ,
            'bedrijftel' => 'required',
            'contact' => 'required' ,
            'contacttel' => 'required',
            // 'remarks' => 'required' ,
            'reason' => 'required',
        ]);    
        // dd($request->input());
        //create
        $SL = new SL;
        $SL->briefnr = 1;
        $SL->windpark = $request->input('windpark');
        $SL->date = $request->input('date');
        $SL->ivname = $request->input('ivname');
        $SL->ivtel = $request->input('ivtel');
        $SL->mvname = $request->input('mvname');
        $SL->mvtel = $request->input('mvtel');
        $SL->plname = $request->input('plname');      
        $SL->pltel = $request->input('pltel'); 
        $SL->bedrijf = $request->input('bedrijf');
        $SL->bedrijftel = $request->input('bedrijftel');
        $SL->contact = $request->input('contact');
        $SL->contacttel = $request->input('contacttel');
        $SL->remarks = "";    
        $SL->reason = $request->input('reason'); 
        $SL->plremarks = "";
        $SL->ivakkoord = "1";
        $SL->mvakkoord = "0"; //Bij weigering blijft 0 op 0 staan en gaat ivakkoord ook naar 0, bij goedkeuring word mvakkoord 1
        $SL->plakkoord = "0";
        // $SL->plaats = request('plaats');
        // $SL->veld = request('veld');
        // $SL->turbine = request('turbine');
        $SL->save();
        // dd($request->input());

        $plaats = request('plaats');
        $veld = request('veld');
        $turbine = request('turbine');
        // $datum = request('datum');
        
        $array = array_map(null, $plaats, $veld, $turbine);
        // dd($array);
        foreach ($array as $data) {
            $stap = new Stappen;
            $stap->brief_id = $SL->id;
            $stap->plaats = $data[0];
            $stap->veld = $data[1];
            $stap->turbine = $data[2];
            $stap->omschrijving = "";
            $stap->voltooid = "";
            $stap->datum = "";
            $stap->save();
        }
        
        // $stap = new Stappen;
        // $stap->brief_id = $SL->id;
        // $stap->plaats = request('plaats');
        // $stap->veld = request('veld');
        // $stap->turbine = request('turbine');
        // $stap->omschrijving = "";
        // $stap->voltooid = "";
        // $stap->datum = request('datum');
        // $stap->save();
        

        // return request('plaats');
        return redirect('/sl/index')->with('success', 'Post Created');
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
        $SL = SL::find($id);
        return view('SL.edit')->with('SL', $SL);
        //check 4 role
        // if(auth()->user()->role == 'admin') {} 
        // else if(auth()->user()->id !== $post->user_id) {
        //     return redirect('/')->with('error', 'Unauthorized page');
        // } 
        
        
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
        $this->validate($request, [
            'windpark' => 'required',
            'date' => 'required',
            'ivname' => 'required' ,
            'ivtel' => 'required',
            'mvname' => 'required' ,
            'mvtel' => 'required',
            'plname' => 'required' ,
            'pltel' => 'required',
            'switchcompany' => 'required' ,
            'switchtel' => 'required',
            'contactname' => 'required' ,
            'contacttel' => 'required',
            'remarks' => 'required' ,
            'reason' => 'required',
        ]);    
        //update
        $SL = SL::find($id);
        // $SL->briefnr = $request->input('schakelbriefnr');
        $SL->windpark = $request->input('windpark');
        $SL->date = $request->input('date');
        $SL->ivname = $request->input('ivname');
        $SL->ivtel = $request->input('ivtel');
        $SL->mvname = $request->input('mvname');
        $SL->mvtel = $request->input('mvtel');
        $SL->plname = $request->input('plname');      
        $SL->pltel = $request->input('pltel'); 
        $SL->bedrijf = $request->input('switchcompany');
        $SL->bedrijftel = $request->input('switchtel');
        $SL->contact = $request->input('contactname');
        $SL->contacttel = $request->input('contacttel');
        $SL->remarks = $request->input('remarks');      
        $SL->reason = $request->input('reason'); 
        $SL->save();
        
        return redirect('/')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SL = SL::find($id);

        //check role?
        // if(auth()->user()->role == 'admin') {} 
        // else if(auth()->user()->id !== $post->user_id) {
        //     return redirect('/')->with('error', 'Unauthorized page');
        // } 

        $SL->delete();
        return redirect('/')->with('success', 'Post Deleted');
    }
}
