@extends('adminlte::page')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Riwayat Pesans' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('riwayat_pesans.riwayat_pesans.destroy', $riwayatPesans->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('riwayat_pesans.riwayat_pesans.index') }}" class="btn btn-primary" title="Show All Riwayat Pesans">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('riwayat_pesans.riwayat_pesans.create') }}" class="btn btn-success" title="Create New Riwayat Pesans">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('riwayat_pesans.riwayat_pesans.edit', $riwayatPesans->id ) }}" class="btn btn-primary" title="Edit Riwayat Pesans">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Riwayat Pesans" onclick="return confirm(&quot;Click Ok to delete Riwayat Pesans.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Pesans</dt>
            <dd>{{ optional($riwayatPesans->Pesan)->jenis }}</dd>
            <dt>Ibus</dt>
            <dd>{{ optional($riwayatPesans->Ibu)->id }}</dd>
            <dt>Created At</dt>
            <dd>{{ $riwayatPesans->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $riwayatPesans->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection