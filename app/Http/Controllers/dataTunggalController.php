<?php

namespace App\Http\Controllers;

use App\Exports\dataExport;
use App\Models\dataTunggal;
use Illuminate\Http\Request;
use App\Imports\importData;
use Illuminate\Contracts\Session\Session as SessionSession;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class dataTunggalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.DataTunggal')->with([
            'dataTunggal' => dataTunggal::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uploadPages.DataTunggalUpload');
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
            'nilai' => 'required'
        ]);

        $data = new dataTunggal;
        $data->nilai = $request->nilai;
        $data->save();
        return to_route('dataTunggal.index')->with('success', 'Data successfully created');
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
        return view('editPages.DataTunggalEdit')->with([
            'dataTunggal' => dataTunggal::find($id),
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
        $request->validate([
            'nilai' => 'required',
        ]);

        $data = dataTunggal::find($id);
        $data->nilai = $request->nilai;
        $data->save();

        return to_route('dataTunggal.index')->with('success', 'Data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataTunggal = dataTunggal::find($id);
        $dataTunggal->delete();

        return back()->with('success', 'Data successfully deleted');
    }
    public function export()
    {
        return Excel::download(new dataExport, 'data.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('fileImport', $nama_file);

        // import data
        Excel::import(new importData, public_path('/fileImport/' . $nama_file));

        // notifikasi dengan session
        //Session::flash('sukses', 'Data Siswa Berhasil Diimport!');

        // alihkan halaman kembali
        return to_route('dataTunggal.index')->with('success', 'Data successfully imported');    }
}
