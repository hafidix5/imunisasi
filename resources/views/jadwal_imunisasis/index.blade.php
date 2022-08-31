@extends('adminlte::page')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Jadwal Imunisasi</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('jadwal_imunisasis.jadwal_imunisasi.create') }}" class="btn btn-success" title="Create New Jadwal Imunisasi">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($jadwalImunisasis) == 0)
            <div class="panel-body text-center">
                <h4>Tidak ada Jadwal Imunisasis Tersedia.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Jenis Imunisasis</th>
                            <th>Tempat</th>
                            <th>Tanggal</th>
                            <th>Waktu Pemberian</th>
                            <th>Berat Badan</th>
                            <th>Panjang Badan</th>
                            <th>Suhu</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Users</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($jadwalImunisasis as $jadwalImunisasi)
                        <tr>
                            <td>{{ optional($jadwalImunisasi->JenisImunisasi)->nama }}</td>
                            <td>{{ $jadwalImunisasi->tempat }}</td>
                            <td>{{ $jadwalImunisasi->tanggal }}</td>
                            <td>{{ $jadwalImunisasi->waktu_pemberian }}</td>
                            <td>{{ $jadwalImunisasi->berat_badan }}</td>
                            <td>{{ $jadwalImunisasi->panjang_badan }}</td>
                            <td>{{ $jadwalImunisasi->suhu }}</td>
                            <td>{{ $jadwalImunisasi->status }}</td>
                            <td>{{ $jadwalImunisasi->keterangan }}</td>
                            <td>{{ optional($jadwalImunisasi->User)->name }}</td>

                            <td>

                                <form method="POST" action="{!! route('jadwal_imunisasis.jadwal_imunisasi.destroy', $jadwalImunisasi->anaks_id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('jadwal_imunisasis.jadwal_imunisasi.show', $jadwalImunisasi->anaks_id ) }}" class="btn btn-info" title="Show Jadwal Imunisasi">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('jadwal_imunisasis.jadwal_imunisasi.edit', $jadwalImunisasi->anaks_id ) }}" class="btn btn-primary" title="Edit Jadwal Imunisasi">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Jadwal Imunisasi" onclick="return confirm(&quot;Click Ok to delete Jadwal Imunisasi.&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $jadwalImunisasis->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection