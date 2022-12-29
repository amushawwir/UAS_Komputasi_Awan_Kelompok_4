@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome, You are admin!') }}
                </div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="float-right my-2">
                            <a class="btn btn-success" href="{{ route('admin.index') }}">Dashboard Admin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection