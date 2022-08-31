
<div class="form-group {{ $errors->has('users_id') ? 'has-error' : '' }}">
    <label for="users_id" class="col-md-2 control-label">Pengguna</label>
    <div class="col-md-10">
        <select class="form-control" id="users_id" name="users_id" required="true">
        	    <option value="" style="display: none;" {{ old('users_id', optional($usersWilayahs)->users_id ?: '') == '' ? 'selected' : '' }} disabled selected>Pilih Pengguna</option>
        	@foreach ($Users as $key => $User)
			    <option value="{{ $key }}" {{ old('users_id', optional($usersWilayahs)->users_id) == $key ? 'selected' : '' }}>
			    	{{ $User }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('users_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('wilayah_kerjas_id') ? 'has-error' : '' }}">
    <label for="wilayah_kerjas_id" class="col-md-2 control-label">Wilayah Kerja</label>
    <div class="col-md-10">
        <select class="form-control" id="wilayah_kerjas_id" name="wilayah_kerjas_id" required="true">
        	    <option value="" style="display: none;" {{ old('wilayah_kerjas_id', optional($usersWilayahs)->wilayah_kerjas_id ?: '') == '' ? 'selected' : '' }} disabled selected>Pilih Wilayah Kerja</option>
        	@foreach ($wilayah_kerjas as $key => $wilayah_kerja)
			    <option value="{{ $key }}" {{ old('wilayah_kerjas_id', optional($usersWilayahs)->wilayah_kerjas_id) == $key ? 'selected' : '' }}>
			    	{{ $wilayah_kerja }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('wilayah_kerjas_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


