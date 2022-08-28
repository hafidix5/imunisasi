
<div class="form-group {{ $errors->has('pesans_id') ? 'has-error' : '' }}">
    <label for="pesans_id" class="col-md-2 control-label">Pesans</label>
    <div class="col-md-10">
        <select class="form-control" id="pesans_id" name="pesans_id" required="true">
        	    <option value="" style="display: none;" {{ old('pesans_id', optional($riwayatPesans)->pesans_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select pesans</option>
        	@foreach ($Pesans as $key => $Pesan)
			    <option value="{{ $key }}" {{ old('pesans_id', optional($riwayatPesans)->pesans_id) == $key ? 'selected' : '' }}>
			    	{{ $Pesan }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('pesans_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ibus_id') ? 'has-error' : '' }}">
    <label for="ibus_id" class="col-md-2 control-label">Ibus</label>
    <div class="col-md-10">
        <select class="form-control" id="ibus_id" name="ibus_id" required="true">
        	    <option value="" style="display: none;" {{ old('ibus_id', optional($riwayatPesans)->ibus_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select ibus</option>
        	@foreach ($Ibus as $key => $Ibu)
			    <option value="{{ $key }}" {{ old('ibus_id', optional($riwayatPesans)->ibus_id) == $key ? 'selected' : '' }}>
			    	{{ $Ibu }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('ibus_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

