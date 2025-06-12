<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use App\Models\JanjiPeriksa;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemeriksaController extends Controller
{
    public function index():View
    {
        $jadwalPeriksa = JadwalPeriksa::where('id_dokter', Auth::user()->id)
            ->where('status', true)
            ->first();

        $janjiPeriksas = JanjiPeriksa::where('id_jadwal_periksa',$jadwalPeriksa->id)->get();

        return view(view:'dokter.memeriksa.index')->with([
            'janjiPeriksas' => $janjiPeriksas,
        ]);
    }
    public function edit():View
    {
        
           
        return view(view:'dokter.memeriksa.edit');
    }
    public function periksa():View
    {
        return view(view:'dokter.memeriksa.periksa');
    }
   
   
}
