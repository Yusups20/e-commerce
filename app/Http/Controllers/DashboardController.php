<?php

namespace App\Http\Controllers;

use App\Charts\KategoriChart;
use App\Charts\PenerbitChart;
use App\Charts\PenulisChart;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();
 
        $kategoriLabels = [];
        $kategoriData = [];
        $penulisLabels = [];
        $penulisData = [];
        $penerbitLabels = [];
        $penerbitData = [];
        
        foreach($kategori as $item) {
            $kategoriLabels[] = $item->nama;
            $kategoriData[] = $item->buku()->count();
        }

        foreach ($penulis as $item) {
            $penulisLabels[] = $item->nama;
            $penulisData[] = $item->buku()->count();
        }

        foreach ($penerbit as $item) {
            $penerbitLabels[] = $item->nama;
            $penerbitData[] = $item->buku()->count();
        }

        // dd([
        //     ["kate$kategoriLabels" => $kategoriLabels],
        //     ["kate$kategoriData" => $kategoriData]
        // ]);

        $kategoriChart = new KategoriChart();
        $kategoriChart->labels($kategoriLabels);
        $kategoriChart->dataset('Jumlah buku','bar',$kategoriData);

        $penulisChart = new PenulisChart();
        $penulisChart->labels($penulisLabels);
        $penulisChart->dataset('Jumlah buku','bar',$penulisData);

        $penerbitChart = new PenerbitChart();
        $penerbitChart->labels($penerbitLabels);
        $penerbitChart->dataset('Jumlah buku','bar',$penerbitData);

        return view('admin.dashboard.index', [
            'kategoriChart' => $kategoriChart,
            'penulisChart' => $penulisChart,    
            'penerbitChart' => $penerbitChart,    
        ]);
    }
}
