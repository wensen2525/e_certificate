<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use App\Exports\ParticipantExport;
use App\Imports\ParticipantImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home2',[
            'participants' => Participant::all()
        ]);
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
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        //
    }

    //adding function

    public function import(Request $request)
	{   
        // dd($request);
        $this->validate($request, [
			'excel' => 'required|mimes:csv,xls,xlsx'
		]);

        Excel::import(new ParticipantImport, $request->file('excel'));

        if ($request->hasFile('excel')) {
            $proofNameToStore = $request->file('excel')->getClientOriginalName();
            $request->file('excel')->storeAs('public/submissions', $proofNameToStore);
        }

        return redirect()->back();
	}

    public function export() 
    {
        return Excel::download(new ParticipantExport, 'datas.xlsx');
    }

    public function deleteAll()
    {

        $participants = Participant::all();

        foreach ($participants as $participant) {
            $participant->delete();
        }

        return redirect()->back();
    }

}
