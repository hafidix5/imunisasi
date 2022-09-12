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
                <h4 class="mt-5 mb-5">Riwayat Pesan</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('jadwal_imunisasis.jadwal_imunisasi.sync') }}" class="btn btn-success" title="Create New Riwayat Pesans">
                    <span class="glyphicon glyphicon-sync" aria-hidden="true">Sync</span>
                </a>
            </div>

        </div>
        
        @if(count($riwayatPesansObjects) == 0)
            <div class="panel-body text-center">
                <h4>Tidak ada Riwayat Pesans Tersedia.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped " id="riwayat">
                    <thead>
                        <tr>
                            <th>Jenis Pesan</th>
                            <th>Ibu</th>
                            <th>Telegram</th>
                            <th>Anak</th>
                            <th>Imunisasi</th>
                            <th>Tanggal</th>
                            <th>Tempat</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($riwayatPesansObjects as $riwayatPesans)
                        <tr>
                            <td>{{ $riwayatPesans->jenis }}</td>
                            <td>{{ $riwayatPesans->ibu }}</td>
                            <td>{{ $riwayatPesans->id_telegram }}</td>
                            <td>{{ $riwayatPesans->anak }}</td>
                            <td>{{ $riwayatPesans->nama }}</td>
                            <td>{{ $riwayatPesans->tanggal}}</td>
                            <td>{{ $riwayatPesans->tempat}}</td>

                            <td>

                                <form method="POST" action="{!! route('riwayat_pesans.riwayat_pesans.destroy', $riwayatPesans->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    {{-- <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('riwayat_pesans.riwayat_pesans.show', $riwayatPesans->id ) }}" class="btn btn-info" title="Show Riwayat Pesans">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('riwayat_pesans.riwayat_pesans.edit', $riwayatPesans->id ) }}" class="btn btn-primary" title="Edit Riwayat Pesans">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Riwayat Pesans" onclick="return confirm(&quot;Click Ok to delete Riwayat Pesans.&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div> --}}

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

       {{--  <div class="panel-footer">
            {!! $riwayatPesansObjects->render() !!}
        </div> --}}
        
        @endif
    
    </div>
    @push('js')
    <script>
        
        $('#riwayat').DataTable({
            "responsive": true,  "autoWidth": true      
    });
    
    </script>
@endpush
@endsection