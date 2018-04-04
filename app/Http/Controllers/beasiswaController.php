<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholarship;
use Illuminate\Support\Facades\DB;
use App\Transformer\ScholarshipTransformer;



class beasiswaController extends Controller
{
    public function show(Scholarship $Scholarship){
    	$beasiswa = $Scholarship::with(['user', 'facilitator', 'categories'])->get();
        // return fractal()
        //     ->collection($beasiswa)
        //     ->transformWith(new ScholarshipTransformer)
        //     ->toArray();

        return response()->json($beasiswa);
    }

    public function single($id){
    	if($id == "order"){
    		return Scholarship::with(['user', 'facilitator', 'categories'])->orderby('created_at', 'asc')->take(3)->get(); 
    	}
    	$single = Scholarship::with(['user', 'facilitator', 'categories'])->where('id', $id)->first();
    	return $single;
    }

    public function priority(){
    	return Scholarship::with(['facilitator', 'categories'])->where('prioritas', 1)->get();
    }

    public function search(Request $request){
            
        // dd($request->date);
        $beasiswa  = Scholarship::search($request->search)->get()->load(['user','facilitator', 'categories']);
         return fractal()
            ->collection($beasiswa)
            ->transformWith(new ScholarshipTransformer)
            ->toArray();
         // $beasiswa  = Scholarship::search($request->search)->where('masa_berlaku', $request->date)->get();
        // return $beasiswa;
    }
}
