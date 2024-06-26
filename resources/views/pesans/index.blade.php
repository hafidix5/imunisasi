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
                <h4 class="mt-5 mb-5">Pesan</h4>
            </div>

            @can('pesans-create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('pesans.pesans.create') }}" class="btn btn-success" title="Create New Pesans">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>
            @endcan
           

        </div>
        
        @if(count($pesansObjects) == 0)
            <div class="panel-body text-center">
                <h4>Tidak ada Pesan Tersedia.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Pesan</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pesansObjects as $pesans)
                        <tr>
                            <td>{{ $pesans->jenis }}</td>
                            <td>{{ $pesans->pesan }}</td>

                            <td>

                                <form method="POST" action="{!! route('pesans.pesans.destroy', $pesans->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @can('pesans-list')
                                        <a href="{{ route('pesans.pesans.show', $pesans->id ) }}" class="btn btn-info" title="Show Pesans">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        @endcan
                                        @can('pesans-edit')
                                        <a href="{{ route('pesans.pesans.edit', $pesans->id ) }}" class="btn btn-primary" title="Edit Pesans">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endcan
                                        @can('pesans-delete')
                                        <button type="submit" class="btn btn-danger" title="Delete Pesans" onclick="return confirm(&quot;Click Ok to delete Pesans.&quot;)">
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
            {!! $pesansObjects->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection