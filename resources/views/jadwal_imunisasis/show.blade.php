@extends('adminlte::page')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Jadwal Imunisasi' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('jadwal_imunisasis.jadwal_imunisasi.destroy', $jadwalImunisasi->anaks_id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('jadwal_imunisasis.jadwal_imunisasi.index') }}" class="btn btn-primary" title="Show All Jadwal Imunisasi">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('jadwal_imunisasis.jadwal_imunisasi.create') }}" class="btn btn-success" title="Create New Jadwal Imunisasi">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('jadwal_imunisasis.jadwal_imunisasi.edit', $jadwalImunisasi->anaks_id ) }}" class="btn btn-primary" title="Edit Jadwal Imunisasi">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Jadwal Imunisasi" onclick="return confirm(&quot;Click Ok to delete Jadwal Imunisasi.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Jenis Imunisasis</dt>
            <dd>{{ optional($jadwalImunisasi->JenisImunisasi)->nama }}</dd>
            <dt>Tempat</dt>
            <dd>{{ $jadwalImunisasi->tempat }}</dd>
            <dt>Tanggal</dt>
            <dd>{{ $jadwalImunisasi->tanggal }}</dd>
            <dt>Waktu Pemberian</dt>
            <dd>{{ $jadwalImunisasi->waktu_pemberian }}</dd>
            <dt>Berat Badan</dt>
            <dd>{{ $jadwalImunisasi->berat_badan }}</dd>
            <dt>Panjang Badan</dt>
            <dd>{{ $jadwalImunisasi->panjang_badan }}</dd>
            <dt>Suhu</dt>
            <dd>{{ $jadwalImunisasi->suhu }}</dd>
            <dt>Status</dt>
            <dd>{{ $jadwalImunisasi->status }}</dd>
            <dt>Keterangan</dt>
            <dd>{{ $jadwalImunisasi->keterangan }}</dd>
            <dt>Users</dt>
            <dd>{{ optional($jadwalImunisasi->User)->name }}</dd>
            <dt>Created At</dt>
            <dd>{{ $jadwalImunisasi->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $jadwalImunisasi->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection