<?php

namespace App\Http\Controllers;

use App\Exports\BukuExport;
use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Penerbit;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $buku = Buku::where('judul', 'like', '%' . $search . '%')->latest()->paginate(5);

        return view('admin.buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.buku.create', [
            'listKategori' => Kategori::all(),
            'listPenulis' => Penulis::all(),
            'listPenerbit' => Penerbit::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $file_name = $request->image->getClientOriginalName();

        // $request->image->storeAs('buku', $file_name);

        $request->validate([
            'judul' => 'required',
            'id_kategori' => 'required',
            'id_penulis' => 'required',
            'id_penerbit' => 'required',
            'berkas_sampul' => 'image|file|max:1024'
        ]);

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->slug = Str::slug($request->judul, '-');
        $buku->id_kategori = $request->id_kategori;
        $buku->id_penulis = $request->id_penulis;
        $buku->id_penerbit = $request->id_penerbit;

        $berkas_sampul = $request->file('berkas_sampul');

        if ($berkas_sampul != null) { // jika berkas_sampul ada atau diupload
            $nama_berkas = rand(100, 9999) . '-' . $berkas_sampul->getClientOriginalName();
            $berkas_sampul->storeAs('gambar-sampul', $nama_berkas);
            $buku->berkas_sampul = $nama_berkas;
        }

        $buku->save();

        session()->flash('sukses', 'data berhasil ditambahkan');

        return redirect('/buku/index');
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
        $buku = Buku::findOrFail($id);

        return view('admin.buku.edit', [
            'buku' => $buku,
            'listKategori' => Kategori::all(),
            'listPenulis' => Penulis::all(),
            'listPenerbit' => Penerbit::all()
        ]);
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);

        return view('admin.buku.detail', [
            'buku' => $buku,
            'listKategori' => Kategori::all(),
            'listPenulis' => Penulis::all(),
            'listPenerbit' => Penerbit::all()
        ]);
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
        $buku = Buku::findOrFail($id);
        $buku->judul = $request->judul;
        $buku->slug = Str::slug($request->judul, '-');
        $buku->id_kategori = $request->id_kategori;
        $buku->id_penulis = $request->id_penulis;
        $buku->id_penerbit = $request->id_penerbit;

        $berkas_sampul = $request->file('berkas_sampul');

        if ($berkas_sampul != null) { // jika berkas_sampul ada atau diupload
            $nama_berkas = rand(100, 9999) . '-' . $berkas_sampul->getClientOriginalName();
            $berkas_sampul->storeAs('gambar-sampul', $nama_berkas);
            $buku->berkas_sampul = $nama_berkas;
        }

        $buku->save();

        session()->flash('sukses', 'data berhasil diupdate');

        return redirect('/buku/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        session()->flash('sukses', 'data berhasil dihapus');

        return redirect('/buku/index');
    }

    /**
     * Export detail buku
     * 
     * @param int $id
     */

    public function exportPdf($id)
    {
        $buku = Buku::findOrFail($id);

        $pdf = Pdf::loadView('admin.buku.export-pdf', [
            'buku' => $buku
        ]);

        return $pdf->stream();
    }

    public function exportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'JUDUL');
        $sheet->setCellValue('C1', 'KATEGORI');
        $sheet->setCellValue('D1', 'PENULIS');
        $sheet->setCellValue('E1', 'PENERBIT');
        $sheet->setCellValue('F1', 'SAMPUL');

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->getAutoSize(true);
        $sheet->getColumnDimension('C')->getAutoSize(true);
        $sheet->getColumnDimension('D')->getAutoSize(true);
        $sheet->getColumnDimension('E')->getAutoSize(true);
        $sheet->getColumnDimension('F')->getAutoSize(true);

        $headerStyle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'ffffff']
            ],
            'aligment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '273bd6',
                ],
            ],
        ];

        $sheet->getStyle("A1:F1")->applyFromArray($headerStyle);
        $sheet->getStyle('A1:F1')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A')->getAlignment()->setVertical('center');
        $sheet->getStyle('F')->getAlignment()->setVertical('center');

        $buku = Buku::all();

        $baris = 2;
        $no = 1;

        foreach ($buku as $item) {
            $sheet->setCellValue("A$baris", $no);
            $sheet->setCellValue("B$baris", $item->judul);
            $sheet->setCellValue("C$baris", $item->kategori->nama);
            $sheet->setCellValue("D$baris", $item->penulis->nama);
            $sheet->setCellValue("E$baris", $item->penerbit->nama);
            $sheet->setCellValue("F$baris", $item->berkas_sampul);
            $baris++;
            $no++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
        header('Content-Disposition: attachment; filename="myfile.xlsx"');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
