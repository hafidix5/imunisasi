@extends('adminlte::page')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <span class="pull-left">
                <h4 class="mt-5 mb-5">Create New Jadwal Imunisasi</h4>
            </span>
            @can('jadwalimunisasis-create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('jadwal_imunisasis.jadwal_imunisasi.index') }}" class="btn btn-primary"
                    title="Show All Jadwal Imunisasi">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </div>
            @endcan
           

        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('jadwal_imunisasis.jadwal_imunisasi.store') }}" accept-charset="UTF-8"
                id="create_jadwal_imunisasi_form" name="create_jadwal_imunisasi_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('jadwal_imunisasis.form', [
                    'jadwalImunisasi' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Add">
                    </div>
                </div>

            </form>

        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                $('#jenis_imunisasis_id').select2({
                    width: 'responsive', 
                });
                $('#anaks_id').select2({
                    width: 'responsive', 
                });
            });
        </script>
    @endpush
@endsection
