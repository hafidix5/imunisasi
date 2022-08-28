@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Users Wilayahs' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('users_wilayahs.users_wilayahs.destroy', $usersWilayahs->wilayah_kerjas_id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('users_wilayahs.users_wilayahs.index') }}" class="btn btn-primary" title="Show All Users Wilayahs">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('users_wilayahs.users_wilayahs.create') }}" class="btn btn-success" title="Create New Users Wilayahs">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('users_wilayahs.users_wilayahs.edit', $usersWilayahs->wilayah_kerjas_id ) }}" class="btn btn-primary" title="Edit Users Wilayahs">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Users Wilayahs" onclick="return confirm(&quot;Click Ok to delete Users Wilayahs.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Users</dt>
            <dd>{{ optional($usersWilayahs->User)->name }}</dd>
            <dt>Created At</dt>
            <dd>{{ $usersWilayahs->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $usersWilayahs->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection