<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Certificate;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        //
    }

    // adding function

    public function download(Participant $participant){
        $length_name = Str::length($participant->name);
        // dd($length_name);
        $pdf = Pdf::loadView('certificates.pdf',[
            'participant' => $participant,
            'length_name' => $length_name
        ])->setPaper('a4', 'landscape');
        return $pdf->download($participant->name.'.pdf');

    }

    public function downloadAllCertificates($scale){
        if($scale === '1 - 25'){
            $participants = Participant::all()->take(25);
        }
        elseif($scale === '26 - 50'){
            $participants = Participant::all()->skip(25)->take(25);
        }elseif($scale === '51 - 75'){
            $participants = Participant::all()->skip(50)->take(25);
        }
            

        foreach($participants as $participant) {
            $length_name = Str::length($participant->name);
            $pdf = Pdf::loadView('certificates.pdf',[
                'participant' => $participant,
                'length_name' => $length_name
            ])->setPaper('a4', 'landscape');

            $content = $pdf->download();
            if($participant->position === 'Liaison Officer'){
                Storage::put('public/LO/'.$participant->competition.'/'.$participant->name.'.pdf',$content);
            }
            else{
                Storage::put('public/custom/'.$participant->competition.'/'.$participant->name.'.pdf',$content);
            }
        }

           
        return redirect()->back();
    }

    public function save(Participant $participant){
        $length_name = Str::length($participant->name);
        // dd($length_name);
        $pdf = Pdf::loadView('certificates.pdf',[
            'participant' => $participant,
            'length_name' => $length_name
        ])->setPaper('a4', 'landscape');

        $content = $pdf->download();

        Storage::put('public/custom/'.$participant->competition.'/'.$participant->name.'.pdf',$content);
        return redirect()->back();
    }
    // 
    public function send(Participant $participant){
        
        Mail::to($participant->email)->send(new SendMail($participant));

        return redirect()->route('participants.index')->with('success', 'Certificate sent successfully.');
    }
    public function viewpdf(){
        return view('certificates.pdf-view');
    }

    public function sendAllCertificates($scale){
        if($scale === '1 - 2'){
            $participants = Participant::all()->take(2);
        }   

        foreach($participants as $participant) {
            Mail::to($participant->email)->send(new SendMail($participant));
        }
        return redirect()->route('participants.index')->with('success', 'Certificate sent successfully.');
    }
}
