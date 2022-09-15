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
                <h4 class="mt-5 mb-5">Data Anak</h4>
            </div>
            @can('anaks-create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                
                <a href="{{ route('anaks.anak.create') }}" class="btn btn-success" title="Create New Anak">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
                
              
            </div>
            @endcan
        </div>
        
        @if(count($anaks) == 0)
            <div class="panel-body text-center">
                <h4>Tidak ada Data Anak Tersedia.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped " id="data_anak">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Ibu</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($anaks as $anak)
                        <tr>
                            <td>{{ $anak->nama }}</td>
                            <td>{{ $anak->tgl_lahir }}</td>
                            @if ($anak->jenis_kelamin=='p')
                            <td>Perempuan</td>
                                @else
                                <td>Laki-laki</td>
                            @endif
                            {{-- <td>{{ $anak->jenis_kelamin }}</td> --}}
                            <td>{{ $anak->ibu }}</td>

                            <td>

                                <form method="POST" action="{!! route('anaks.anak.destroy', $anak->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @can('anaks-list')
                                        <a href="{{ route('anaks.anak.show', $anak->id ) }}" class="btn btn-info" title="Show Anak">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        @endcan
                                       @can('anaks-edit')
                                       <a href="{{ route('anaks.anak.edit', $anak->id ) }}" class="btn btn-primary" title="Edit Anak">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>
                                       @endcan
                                        @can('anaks-delete')
                                        <button type="submit" class="btn btn-danger" title="Delete Anak" onclick="return confirm(&quot;Click Ok to delete Anak.&quot;)">
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
            {!! $anaks->render() !!}
        </div>
        
        @endif
    
    </div>
    @push('js')
    <script>
        
       /*  $('#data_anak').DataTable({
            "responsive": true,
            "paging": false,
            "displayStart": false,
        }); */

        $("#data_anak").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>
@endpush
@endsection