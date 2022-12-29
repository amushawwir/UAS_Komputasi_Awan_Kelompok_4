@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 align="center"><b>IDENTITAS CALON SISWA</b> </h5>

               
                    <table class="table table-sm">
                      <tbody>
                        <tr>
                          <td><img src="{{ asset('storage/'.$user->url_foto) }}"  width="120px"></td>
                        </tr>
                        <tr>
                          <td class="table-info" width="200px">Nama Lengkap</td>
                          <td>: {{ $user->nama }}</td>
                        </tr>
                        <tr>
                          <td class="table-info">NISN</td>
                          <td>: {{ $user->nisn }}</td>
                        </tr>
                        <tr>
                          <td class="table-info">TTL</td>
                          <td>: {{ $user->tempat_lahir }}, {{ $user->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                          <td class="table-info">Jenis Kelamin</td>
                          <td>: {{ $user->jenisKel }}</td>
                        </tr> 
                        <tr>
                          <td class="table-info">Email</td>
                          <td>: {{ $user->email }}</td>
                        </tr>  
                        <tr>
                          <td class="table-info" width="200px">Alamat</td>
                          <td>: {{ $user->alamat }}</td>
                        </tr>
                        <tr>
                          <td class="table-info">No. Telp/Handphone</td>
                          <td>: {{ $user->telp }}</td>
                        </tr>
                        <tr>
                          <td class="table-info">Agama</td>
                          <td>: {{ $user->agama }}</td>
                        </tr>
                        <tr>
                          <td class="table-info">Asal Sekolah</td>
                          <td>: {{ $user->asalSekolah }}</td>
                        </tr>
                        <tr>
                          <td class="table-info" width="200px">Jurusan</td>
                          <td>: {{ $user->jurusan }}</td>
                        </tr>               
                      </tbody>
                    </table>

                    <br>
                    <h5 align="center"><b>IDENTITAS ORANG TUA</b> </h5>
                    <br>

                    <table class="table table-sm">
                    <tbody>
                        <tr>
                          <td class="table-info" width="200px">Nama Ayah</td>
                          <td>: {{ $user->nama_ayah }}</td>
                        </tr>
                        <tr>
                          <td class="table-info">Pekerjaan Ayah</td>
                          <td>: {{ $user->pekerjaan_ayah }}</td>
                        </tr>
                        <tr>
                          <td class="table-info">Riwayat Pendidikan Ayah</td>
                          <td>: {{ $user->pendidikan_ayah }}</td>
                        </tr> <tr>
                          <td class="table-info" width="200px">Nama Ibu</td>
                          <td>: {{ $user->nama_ibu }}</td>
                        </tr>
                        <tr>
                          <td class="table-info">Pekerjaan Ibu</td>
                          <td>: {{ $user->pekerjaan_ibu }}</td>
                        </tr>
                        <tr>
                          <td class="table-info">Riwayat Pendidikan Ibu</td>
                          <td>: {{ $user->pendidikan_ibu }}</td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="col-lg-12 margin-tb">
                        <div class="float-right my-2">
                            <a class="btn btn-success" href="{{ route('cetak_formulir') }}">Cetak Formulir</a>
                        </div>
                        <div class="float-right my-2">
                            <a class="btn btn-success" href="{{ route('edit') }}">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection