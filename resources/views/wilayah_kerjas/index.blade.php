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
                <h4 class="mt-5 mb-5">Wilayah Kerja</h4>
            </div>
            @can('wilayahkerjas-create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('wilayah_kerjas.wilayah_kerjas.create') }}" class="btn btn-success" title="Create New Wilayah Kerjas">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>
            @endcan
          

        </div>
        
        @if(count($wilayahKerjasObjects) == 0)
            <div class="panel-body text-center">
                <h4>Tidak ada Wilayah Kerjas Tersedia</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Nama</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($wilayahKerjasObjects as $wilayahKerjas)
                        <tr>
                            <td>{{ $wilayahKerjas->jenis }}</td>
                            <td>{{ $wilayahKerjas->nama }}</td>

                            <td>

                                <form method="POST" action="{!! route('wilayah_kerjas.wilayah_kerjas.destroy', $wilayahKerjas->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @can('wilayahkerjas-list')
                                        <a href="{{ route('wilayah_kerjas.wilayah_kerjas.show', $wilayahKerjas->id ) }}" class="btn btn-info" title="Show Wilayah Kerjas">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        @endcan
                                        @can('wilayahkerjas-create')
                                        <a href="{{ route('wilayah_kerjas.wilayah_kerjas.edit', $wilayahKerjas->id ) }}" class="btn btn-primary" title="Edit Wilayah Kerjas">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endcan
                                        @can('wilayahkerjas-delete')
                                        <button type="submit" class="btn btn-danger" title="Delete Wilayah Kerjas" onclick="return confirm(&quot;Click Ok to delete Wilayah Kerjas.&quot;)">
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
            {!! $wilayahKerjasObjects->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection