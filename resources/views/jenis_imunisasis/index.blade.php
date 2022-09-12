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
                <h4 class="mt-5 mb-5">Jenis Imunisasi</h4>
            </div>
            @can('jenisimunisasis-create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('jenis_imunisasis.jenis_imunisasi.create') }}" class="btn btn-success" title="Create New Jenis Imunisasi">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>
            @endcan
           

        </div>
        
        @if(count($jenisImunisasis) == 0)
            <div class="panel-body text-center">
                <h4>Tidak ada Jenis Imunisasis Tersedia.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Waktu Tepat</th>
                            <th>Waktu Telat</th>
                            <th>Keterangan</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($jenisImunisasis as $jenisImunisasi)
                        <tr>
                            <td>{{ $jenisImunisasi->nama }}</td>
                            <td>{{ $jenisImunisasi->waktu_tepat }}</td>
                            <td>{{ $jenisImunisasi->waktu_telat }}</td>
                            <td>{{ $jenisImunisasi->keterangan }}</td>

                            <td>

                                <form method="POST" action="{!! route('jenis_imunisasis.jenis_imunisasi.destroy', $jenisImunisasi->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @can('jenisimunisasis-list')
                                        <a href="{{ route('jenis_imunisasis.jenis_imunisasi.show', $jenisImunisasi->id ) }}" class="btn btn-info" title="Show Jenis Imunisasi">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        @endcan
                                        @can('jenisimunisasis-edit')
                                        <a href="{{ route('jenis_imunisasis.jenis_imunisasi.edit', $jenisImunisasi->id ) }}" class="btn btn-primary" title="Edit Jenis Imunisasi">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endcan
                                        @can('jenisimunisasis-delete')
                                        <button type="submit" class="btn btn-danger" title="Delete Jenis Imunisasi" onclick="return confirm(&quot;Click Ok to delete Jenis Imunisasi.&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                        @endcan
                                       
                                        

                                        
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
            {!! $jenisImunisasis->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection