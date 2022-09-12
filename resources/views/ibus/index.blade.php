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
                <h4 class="mt-5 mb-5">Data Ibu</h4>
            </div>
            @can('ibus-create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('ibus.ibu.create') }}" class="btn btn-success" title="Create New Ibu">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>
            @endcan
           

        </div>
        
        @if(count($ibus) == 0)
            <div class="panel-body text-center">
                <h4>Tidak ada Data Ibu Tersedia.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped " id="data_ibu">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tgl Lahir</th>
                            <th>No Hp</th>
                            <th>Alamat</th>
                            <th>Id Telegram</th>
                            <th>Wilayah Kerjas</th>
                            

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($ibus as $ibu)
                        <tr>
                            <td>{{ $ibu->nama }}</td>
                            <td>{{ $ibu->tgl_lahir }}</td>
                            <td>{{ $ibu->no_hp }}</td>
                            <td>{{ $ibu->alamat }}</td>
                           {{--  <td>{{ optional($ibu->WilayahKerja)->jenis }}</td> --}}
                            <td>{{ $ibu->id_telegram }}</td>
                            <td>{{ $ibu->wilayah }}</td>

                            <td>

                                <form method="POST" action="{!! route('ibus.ibu.destroy', $ibu->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @can('ibus-list')
                                        <a href="{{ route('ibus.ibu.show', $ibu->id ) }}" class="btn btn-info" title="Show Ibu">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        @endcan
                                        @can('ibus-edit')
                                        <a href="{{ route('ibus.ibu.edit', $ibu->id ) }}" class="btn btn-primary" title="Edit Ibu">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endcan
                                        @can('ibus-delete')
                                        <button type="submit" class="btn btn-danger" title="Delete Ibu" onclick="return confirm(&quot;Click Ok to delete Ibu.&quot;)">
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
            {!! $ibus->render() !!}
        </div>
        
        @endif
    
    </div>
    @push('js')
    <script>
        
        $('#data_ibu').DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>
@endpush
@endsection