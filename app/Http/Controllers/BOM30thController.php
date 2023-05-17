<?php

namespace App\Http\Controllers;

use App\Models\BOM30th;
use App\Exports\BomExport;
use App\Imports\BomImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreBOM30thRequest;
use App\Http\Requests\UpdateBOM30thRequest;

class BOM30thController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home',[
            'boms' => BOM30th::all()
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
    public function show(BOM30th $bOM30th)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BOM30th $bOM30th)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BOM30th $bOM30th)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BOM30th $bOM30th)
    {
        //
    }

    public function makePassword(){

        $boms = BOM30th::all();
        foreach ($boms as $bom){
            

            $password = 'BNEC.' . $bom->nim;

            $bom->update([
                'password' => $password
            ]);
        }

        return redirect()->back();
    }

    public function makeHash(Request $request){
        
        $boms = BOM30th::all();
        foreach ($boms as $bom){
            $hashpassword = Hash::make($bom->password);

            // if(Hash::check('BNEC.2540127591', '$2y$10$xoBnngeHZh0JsWD2wkyboOEEdDVQjOHNKEg4ba72.gt7K45GNaKXS')){
            //     dd("same");
            // }else{
            //     dd("not same");
            // }
            
            $bom->update([
                'hashpassword' => $hashpassword
            ]);
        }

        return redirect()->back();
    }

    public function import(Request $request)
	{   
        // dd($request);
        $this->validate($request, [
			'excel' => 'required|mimes:csv,xls,xlsx'
		]);

        Excel::import(new BomImport, $request->file('excel'));

        if ($request->hasFile('excel')) {
            $proofNameToStore = $request->file('excel')->getClientOriginalName();
            $request->file('excel')->storeAs('public/data_boms', $proofNameToStore);
        }

        return redirect()->back();
	}

    public function export() 
    {
        return Excel::download(new BomExport, 'data_boms.xlsx');
    }

    public function deleteAll()
    {

        $participants = BOM30th::all();

        foreach ($participants as $participant) {
            $participant->delete();
        }

        return redirect()->back();
    }
}
