<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Tabungan;
use App\Models\Bunga;
use Illuminate\Support\Carbon;

class MutasiController extends Controller
{
    public function listMutasi()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->get();

        return view('mutasi.list', compact('transactions'));
    }

    public function listBunga()
    {
        $from   = date("Y-n-j", strtotime("first day of previous month"));
        $to     = date("Y-n-j", strtotime("last day of previous month"));
       
        $tabungan   = Tabungan::whereBetween('created_at', [$from,$to])->min('saldo');
        $bunga      = round($tabungan * (6/100) * date('t') / 365);
        // $bunga      = rupiah($bunga);
        $bungas = Bunga::orderBy('created_at', 'desc')->get(); 
        return view('mutasi.bunga', compact('bunga', 'bungas'));
    }

    public function storeBunga()
    {
        // akhir 2 bulan dan awal bulan
        $a = date('n')-2;

        $from   = date("Y-n-j", strtotime("first day of previous month"));
        $to     = date("Y-n-j", strtotime("last day of previous month"));
        $from1   =  date("Y-n-t",strtotime("-2 Months"));
        $from2   = date("Y-n-01");
        $to2     = date("Y-n-t");
        // ambil data saldo minimum
        $tabungan   = Tabungan::whereBetween('created_at', [$from,$to])->min('saldo');
        // last day 2 prev month --- first day this month
        $bunga    = Bunga::whereBetween('created_at', [$from1,$from2])->first();
        // first day this month --- last day this month
        $bunga3   = Bunga::whereBetween('created_at', [$from2,$to2])->first();
        
        if($bunga == null && $bunga3 == null){
            
            // rumus bunga
            $bunga2      = round($tabungan * (6/100) * date('t') / 365);
            $tabungans = Tabungan::get();
            foreach ($tabungans as $tabungan) {
                $prev = $tabungan->saldo;
                $tabungan->update([
                    'saldo' => $prev + $bunga2,
                ]);
            }

            Bunga::insert([
                'jumlah' => $bunga2,
                'created_at' => Carbon::now()
            ]);
        }else{
            return redirect('/mutasi/bunga')->with('err', 'bunga sudah di kirim');    
        }
        
        return redirect('/mutasi/bunga')->with('msg', 'bunga berhasil di kirim');
        

    }
    
}
