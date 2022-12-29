@extends('admin.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>TAMPILAN DATA AKUN USER</h2>
        </div>
        <div class="float-right my-2">
            <a class="btn btn-success" href="{{ route('admin.create') }}"> Input Akun</a>
        </div>
    </div>
</div>

<form class="form" method="get" action="{{ route('admin.index') }}">
    <div class="form-group w-100 mb-3">
        <label for="search" class="d-block mr-2">Search Form</label>
        <input type="text" name="search" class="form-control w-75 d-inline" id="search"
            placeholder="Search your data..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary mb-1">Cari</button>
    </div>
</form>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Username</th>
        <th>Nama</th>
        <th>Email</th>
    </tr>
    @foreach ($paginate as $a)
    <tr>
        <td>{{ $a->username }}</td>
        <td>{{ $a->name }}</td>
        <td>{{ $a->email }}</td>
        <td>
            <form action="{{ route('admin.destroy',$a->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('admin.show',$a->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('admin.edit',$a->id) }}">Edit</a>

                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('yakin?');">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{{-- Halaman : {{ $akun->currentPage() }} <br />
Jumlah Data : {{ $akun->total() }} <br />
Data Per Halaman : {{ $akun->perPage() }} <br /> --}}
<br>{{ $paginate->links() }}</br>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-right my-2">
            <a class="btn btn-success" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
        </div>
    </div>
</div>
@endsection