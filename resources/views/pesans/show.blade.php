@extends('adminlte::page')
@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Pesan' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('pesans.pesans.destroy', $pesans->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('pesans.pesans.index') }}" class="btn btn-primary" title="Show All Pesans">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('pesans.pesans.create') }}" class="btn btn-success" title="Create New Pesans">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('pesans.pesans.edit', $pesans->id ) }}" class="btn btn-primary" title="Edit Pesans">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Pesans" onclick="return confirm(&quot;Click Ok to delete Pesans.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Jenis</dt>
            <dd>{{ $pesans->jenis }}</dd>
            <dt>Pesan</dt>
            <dd>{{ $pesans->pesan }}</dd>
            <dt>Created At</dt>
            <dd>{{ $pesans->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $pesans->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection