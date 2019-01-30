<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Tabungan;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::get();
        
        return view('member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create');
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
            'ktp'           => 'required|numeric|unique:members,ktp',
            'nama'          => 'required|min:5',
            'alamat'        => 'required|min:10',
        ]);

        $member = Member::where('ktp', '=', $request->ktp)->first();
        
        if($member == null){
            Member::create([
                'ktp'           => $request->ktp,
                'nama'          => $request->nama,
                'alamat'        => $request->alamat
            ]);     
        }else{
            return redirect('/member/create')->with('err', 'No KTP sudah ada');  
        }
        
        return redirect('/member/create')->with('msg', 'Anggota berhasil di tambahkan');
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
        $member = Member::findOrFail($id);
        
        return view('member.edit', compact('member'));
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
        $request->validate([
            'ktp'           => 'required|numeric|unique:members,ktp',
            'nama'          => 'required|min:5',
            'alamat'        => 'required|min:10',
        ]);
        
        $member = Member::findOrFail($id);
        $member->update([
                'ktp'           => $request->ktp,
                'nama'          => $request->nama,
                'alamat'        => $request->alamat
            ]);
        
        return redirect('/member')->with('msg','Anggota berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect('/')->with('msg', 'Anggota berhasil di hapus');
    }
}
