<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SL;
use PDF;
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
        // dd($plaats, $veld, $turbine, $omschrijving, $voltooid);
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
        $SL = SL::find($id);
        return view('SL.show')->with('SL', $SL);
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

    public function PDF($id)
    {
        $SL = SL::find($id);
        $data = [
            'date' => date('d-m-Y H:i:s'),
            'briefnummer' => $SL->briefnr,
            'briefreason' => $SL->reason,
            'datebrief' => $SL->date,
            'bedrijf' => $SL->bedrijf,
            'bedrijftel' => $SL->bedrijftel,
            'contact' => $SL->contact,
            'contacttel' => $SL->contacttel,
            'ivname' => $SL->ivname,
            'ivtel' => $SL->ivtel,
            'mvname' => $SL->mvname,
            'mvtel' => $SL->mvtel,
            'plname' => $SL->plname,
            'pltel' => $SL->pltel,

        ];
        $pdf = PDF::loadView('SL.pdf', $data);

        return $pdf->download('Schakelbrief_'.$SL->briefnr.'.pdf');
    }

    public function Word($id)
    {
        // Schakelbrief gegevens ophalen.
        $SL = SL::find($id);

        //Datum van download
        $date = date('d-m-Y H:i:s');

        // Word file aanmaken en variable definen
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(12);
        $style['unit'] = \PhpOffice\PhpWord\Style\Image::UNIT_PX;
        $phpWord->getSettings()->setZoom('bestFit');
        $section = $phpWord->addSection();
        
        // Word file vullen met schakelbrief info.
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<p style="position:absolute;float:left;top:0;font-size:11px;"><strong>Gedownload op</strong>: '. $date.'</p>');
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<img width="300" height="50" src="https://www.enercon.de/fileadmin/Resources/Public/img/enercon_en.png"/>');
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<h2> Briefnr: (#'.$SL->briefnr.')</h2>');
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<p><strong>Reden voor schakelbrief</strong>: '.$SL->reason.'</p>');
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<p>Windparknaam: '.$SL->windpark.'</p><p>Datum van aanmaak: '.$SL->date.'</p>');
        $section->addTextBreak(1);
        // Styling van tabel
        $tableStyleName = 'Bedrijfsinfo';
        $tableStyle = array('borderBottomSize' => 6, 'borderColor' => '00564c');
        $tableFirstRowStyle = array('borderBottomSize' => 18, 'bold' => true);
        $tableCellStyle = array('borderBottomSize' => 6, 'valign' => 'center');
        $tableFontStyle = array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);

        // Tabel aanmaken voor bedrijfsinfo
        $phpWord->addTableStyle($tableStyleName, $tableStyle, $tableFirstRowStyle);
        $table = $section->addTable($tableStyleName);
        $table->addRow();
        $table->addCell(3000, $tableCellStyle)->addText('Bedrijfsnaam', $tableFontStyle);
        $table->addCell(3000, $tableCellStyle)->addText('Bedrijfstelefoonnummer', $tableFontStyle);
        $table->addRow();
        $table->addCell(3000, $tableCellStyle)->addText($SL->bedrijf);
        $table->addCell(3000, $tableCellStyle)->addText($SL->bedrijftel);
        
        // Tabel aanmaken voor contactinfo
        $section->addTextBreak(1);

        $table = $section->addTable($tableStyleName);
        $table->addRow();
        $table->addCell(3000, $tableCellStyle)->addText('Contactpersoon', $tableFontStyle);
        $table->addCell(3000, $tableCellStyle)->addText('Contact telefoonnummer', $tableFontStyle);
        $table->addRow();
        $table->addCell(3000, $tableCellStyle)->addText($SL->contact);
        $table->addCell(3000, $tableCellStyle)->addText($SL->contacttel);

        $section->addTextBreak(1);

        //Tabel aanmaken voor intern
        $table = $section->addTable($tableStyleName);
        $table->addRow();
        $table->addCell(3500, $tableCellStyle)->addText('Installatieverantwoordelijke', $tableFontStyle);
        $table->addCell(3000, $tableCellStyle)->addText('Werkverantwoordelijke', $tableFontStyle);
        $table->addCell(3000, $tableCellStyle)->addText('Ploegleider', $tableFontStyle);
        $table->addRow();
        $table->addCell(3500, $tableCellStyle)->addText($SL->ivname);
        $table->addCell(3000, $tableCellStyle)->addText($SL->mvname);
        $table->addCell(3000, $tableCellStyle)->addText($SL->plname);
        $table->addRow();
        $table->addCell(3500, $tableCellStyle)->addText($SL->ivtel);
        $table->addCell(3000, $tableCellStyle)->addText($SL->mvtel);
        $table->addCell(3000, $tableCellStyle)->addText($SL->pltel);
        
        $section->addTextBreak(1);
        // Opmerkingen van GO-NL en Opmerkingen voor werkzaamheden tijdens het werk.
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<p>Opmerking GO-NL: </p> <p style="border:1px solid black;">'.$SL->remarks.'</p>');
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<p>Opmerking Tijdens werkzaamheden: </p> <p style="border: 1px solid black;">'.$SL->remarks.'</p>');


        // Word file maken -> Opslaan als Schakelbrief.docx -> Gebruiker laten downloaden als Schakelbrief.docx
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Schakelbrief.docx');
        return response()->download(public_path('Schakelbrief.docx'));
        return redirect('/sl/index');

    }
}
