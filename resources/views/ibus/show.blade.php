@extends('adminlte::page')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Data Ibu' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ibus.ibu.destroy', $ibu->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('ibus.ibu.index') }}" class="btn btn-primary" title="Show All Ibu">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('ibus.ibu.create') }}" class="btn btn-success" title="Create New Ibu">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('ibus.ibu.edit', $ibu->id ) }}" class="btn btn-primary" title="Edit Ibu">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Ibu" onclick="return confirm(&quot;Click Ok to delete Ibu.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Nama</dt>
            <dd>{{ $ibu->nama }}</dd>
            <dt>Tgl Lahir</dt>
            <dd>{{ $ibu->tgl_lahir }}</dd>
            <dt>No Hp</dt>
            <dd>{{ $ibu->no_hp }}</dd>
            <dt>Alamat</dt>
            <dd>{{ $ibu->alamat }}</dd>
            <dt>Wilayah Kerjas</dt>
            <dd>{{ optional($ibu->WilayahKerja)->jenis }}</dd>
            <dt>Id Telegram</dt>
            <dd>{{ $ibu->id_telegram }}</dd>
            <dt>Created At</dt>
            <dd>{{ $ibu->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $ibu->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection