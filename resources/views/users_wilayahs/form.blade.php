
<div class="form-group {{ $errors->has('users_id') ? 'has-error' : '' }}">
    <label for="users_id" class="col-md-2 control-label">Users</label>
    <div class="col-md-10">
        <select class="form-control" id="users_id" name="users_id" required="true">
        	    <option value="" style="display: none;" {{ old('users_id', optional($usersWilayahs)->users_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select users</option>
        	@foreach ($Users as $key => $User)
			    <option value="{{ $key }}" {{ old('users_id', optional($usersWilayahs)->users_id) == $key ? 'selected' : '' }}>
			    	{{ $User }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('users_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

