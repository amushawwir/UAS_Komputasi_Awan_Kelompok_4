<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;



class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('url_foto')){
            $image_name = $request->file('url_foto')->store('image', 'public');
        }
            $request->validate([
                'nama' => 'required|string|max:200',
                'nisn' => 'required|string|max:45',
                'tempat_lahir' => 'required|string|max:45',
                'tanggal_lahir' => 'required',
                'jenisKel' => 'required|string|max:45',
                'email' => 'required|string|max:45',
                'alamat' => 'required',
                'telp' => 'required|string|max:45',
                'agama' => 'required|string|max:45',
                'asalSekolah' => 'required|string|max:100',
                'url_foto' => 'mimes:pdf,jpeg,png,jpg|max:2048',
                'nama_ayah' => 'required|string|max:200',
                'pekerjaan_ayah' => 'required|string|max:100',
                'pendidikan_ayah' => 'required|string|max:100',
                'nama_ibu' => 'required|string|max:200',
                'pekerjaan_ibu' => 'required|string|max:100',
                'pendidikan_ibu' => 'required|string|max:100', 
            ]);            
            $pendaftar = new Pendaftar;
            $pendaftar->nama = $request->get('nama');
            $pendaftar->nisn = $request->get('nisn');
            $pendaftar->tempat_lahir = $request->get('tempat_lahir');
            $pendaftar->tanggal_lahir = $request->get('tanggal_lahir');
            $pendaftar->jenisKel = $request->get('jenisKel');
            $pendaftar->email = $request->get('email');
            $pendaftar->alamat = $request->get('alamat');
            $pendaftar->telp = $request->get('telp');
            $pendaftar->agama = $request->get('agama');
            $pendaftar->asalSekolah = $request->get('asalSekolah');
            $pendaftar->jurusan = $request->get('jurusan');
            $pendaftar->url_foto = $image_name;
            $pendaftar->nama_ayah = $request->get('nama_ayah');
            $pendaftar->pekerjaan_ayah = $request->get('pekerjaan_ayah');
            $pendaftar->pendidikan_ayah = $request->get('pendidikan_ayah');
            $pendaftar->nama_ibu = $request->get('nama_ibu');
            $pendaftar->pekerjaan_ibu = $request->get('pekerjaan_ibu');
            $pendaftar->pendidikan_ibu = $request->get('pendidikan_ibu');

            $user = Auth::user()->id;
            $pendaftar->user_id = $user;
            
            $pendaftar->save();
            return redirect()->route('show')->with('success', 'Registrasi berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $userr = Auth::user()->id;
        $user = DB::table('pendaftar')->where('user_id', $userr)->first();

        return view('user.detail', compact( 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $userr = Auth::user()->id;
        $user = DB::table('pendaftar')->where('user_id', $userr)->first();

        return view('user.edit', compact('userr', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
        {
            if ($request->file('url_foto')){
                $image_name = $request->file('url_foto')->store('image', 'public');
            }
                $request->validate([
                    'nama' => 'required|string|max:200',
                    'nisn' => 'required|string|max:45',
                    'tempat_lahir' => 'required|string|max:45',
                    'tanggal_lahir' => 'required',
                    'jenisKel' => 'required|string|max:45',
                    'email' => 'required|string|max:45',
                    'alamat' => 'required',
                    'telp' => 'required|string|max:45',
                    'agama' => 'required|string|max:45',
                    'asalSekolah' => 'required|string|max:100',
                    'url_foto' => 'mimes:pdf,jpeg,png,jpg|max:2048',
                    'nama_ayah' => 'required|string|max:200',
                    'pekerjaan_ayah' => 'required|string|max:100',
                    'pendidikan_ayah' => 'required|string|max:100',
                    'nama_ibu' => 'required|string|max:200',
                    'pekerjaan_ibu' => 'required|string|max:100',
                    'pendidikan_ibu' => 'required|string|max:100',
                ]);            
                $user = Auth::user()->id;
                $pendaftar = Pendaftar::where('user_id', $user)->first(); 
                $pendaftar->nama = $request->get('nama');
                $pendaftar->nisn = $request->get('nisn');
                $pendaftar->tempat_lahir = $request->get('tempat_lahir');
                $pendaftar->tanggal_lahir = $request->get('tanggal_lahir');
                $pendaftar->jenisKel = $request->get('jenisKel');
                $pendaftar->email = $request->get('email');
                $pendaftar->alamat = $request->get('alamat');
                $pendaftar->telp = $request->get('telp');
                $pendaftar->agama = $request->get('agama');
                $pendaftar->asalSekolah = $request->get('asalSekolah');
                $pendaftar->jurusan = $request->get('jurusan');
                $pendaftar->url_foto = $image_name;
                $pendaftar->nama_ayah = $request->get('nama_ayah');
                $pendaftar->pekerjaan_ayah = $request->get('pekerjaan_ayah');
                $pendaftar->pendidikan_ayah = $request->get('pendidikan_ayah');
                $pendaftar->nama_ibu = $request->get('nama_ibu');
                $pendaftar->pekerjaan_ibu = $request->get('pekerjaan_ibu');
                $pendaftar->pendidikan_ibu = $request->get('pendidikan_ibu');
                $pendaftar->user_id = $user;
                
                $pendaftar->save();
                return redirect()->route('show')->with('success', 'Registrasi berhasil!');
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

    public function cetak_formulir(){

        $userr = Auth::user()->id;
        $user = Pendaftar::where('user_id', $userr)->first();
        $pdf = PDF::loadview('user.cetak_form', compact('userr', 'user'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    
    }
}
