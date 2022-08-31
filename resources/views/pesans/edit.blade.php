@extends('adminlte::page')

@section('content')

    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Pesan' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('pesans.pesans.index') }}" class="btn btn-primary" title="Show All Pesans">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('pesans.pesans.create') }}" class="btn btn-success" title="Create New Pesans">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>

            </div>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('pesans.pesans.update', $pesans->id) }}" id="edit_pesans_form" name="edit_pesans_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('pesans.form', [
                                        'pesans' => $pesans,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Simpan">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection