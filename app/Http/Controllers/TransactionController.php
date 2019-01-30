<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Tabungan;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function menyetor()
    {
        return view('transaction.menyetor');
    }

    public function menyetorStore(Request $request)
    {
        $request->validate([
            'norekening' => 'required',
            'jumlah'     => 'required'
        ]);
        // menyecek ada nomor rekening
        $tabungan  = Tabungan::where('norekening', '=', $request->norekening)->first();
        // menyecek pemilik tabungan
        
        $tabungan2 = Tabungan::where('member_id', '=', $tabungan->member->id)->first();
        // dd($tabungan);
        if($tabungan->norekening != null ){
            // insert ke table transaksi
            Transaction::create([
                'withdraw'  => null,
                'menyetor'  => $request->jumlah,
                'member_id' => $tabungan->member->id,
                'tabungan_id' => $tabungan->id,
            ]);
            
            $tabungan2->update([
                'saldo' => $tabungan2->saldo + $request->jumlah,
            ]);

            return redirect('/transaction/menyetor')->with('msg', 'Setoran berhasil');
        
        }else{
            return redirect('/transaction/menyetor')->with('noktp', 'norekening salah');
        }

    }

    public function withdraw()
    {
        return view('transaction.withdraw');
    }

    public function withdrawStore(Request $request)
    {
        $request->validate([
            'norekening' => 'required',
            'jumlah'     => 'required'
        ]);
        // menyecek ada nomor rekening
        $tabungan  = Tabungan::where('norekening', '=', $request->norekening)->first();
        // menyecek pemilik tabungan
        $tabungan2 = Tabungan::where('member_id', '=', $tabungan->member->id)->first();
        
        if($tabungan->norekening != null ){
            // uji saldo lebih dari request
            if ($tabungan->saldo >= $request->jumlah) {
                Transaction::create([
                    'withdraw'  => $request->jumlah,
                    'menyetor'  => null,
                    'member_id' => $tabungan->member->id,
                    'tabungan_id' => $tabungan->id,
                ]);
                
                $tabungan2->update([
                    'saldo' => $tabungan2->saldo - $request->jumlah,
                ]);
    
                return redirect('/transaction/withdraw')->with('msg', 'Withdraw berhasil');
            }else{
                return redirect('/transaction/withdraw')->with('err', 'Saldo tidak mencukupi')->withInput();    
            }
            
        }else{
            return redirect('/transaction/withdraw')->with('err', 'norekening salah')->withInput();
        }

    }

}
