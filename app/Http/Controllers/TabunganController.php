<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Tabungan;

class TabunganController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tabungan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ktp'           => 'required',
            'norekening'    => 'required|unique:tabungans,norekening',
            'saldo'         => 'required|min:3'
        ]);
        // mengecek apakah ktp ada di table
        $member = Member::where('ktp', '=', $request->ktp)->first();    
        // cek apakah member sudah punya rekening
        $tabungan = Tabungan::where('member_id' ,'=', $member->id)->first();
        if ($member != null){
            if ($tabungan == null) {    
                // insert ke saldo
                Tabungan::create([
                    'norekening'    => $request->norekening,
                    'saldo'         => $request->saldo,
                    'member_id'     => $member->id,
                ]);
                return redirect('/tabungan/create')->with('msg', 'Tabungan berhasil di buat');
            }else{
                return redirect('/tabungan/create')->with('noktp', 'Anggota Sudah Punya No Rekening');
            }
        }else{
            return redirect('/tabungan/create')->with('noktp', 'Anggota Belum terdaftar');
        }
   
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
