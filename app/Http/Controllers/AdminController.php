<?php

namespace App\Http\Controllers;

use App\Models\Creation;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showReport(){
        return view('admin.report',[
            'report' => Report::all(),
        ]);
    }

    public function showBanned(){
        return view('admin.ban',[
            'akun' => User::all(),
        ]);
    }

    public function dashboard(){
        $creations = Creation::all()->count();
        $akun = User::all()->where('role','user')->count();
        $report = Report::all()->count();

        return view('admin.home',[
            'jumlah_karya' => $creations,
            'jumlah_akun' => $akun,
            'jumlah_report' => $report,
        ]);
    }

    public function simpan(Request $request){
        Report::create([
            'user_id' => $request->user,
            'report_cats_id' => $request->jenis,
            'report_text' => $request->report
        ]);

        session()->flash('success', 'Laporan berhasil dikirim, terima kasih sudah memberikan feedback');
        return redirect()->route('home');
    }
}
