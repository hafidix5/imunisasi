
<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
    <label for="nama" class="col-md-2 control-label">Nama</label>
    <div class="col-md-10">
        <input class="form-control" name="nama" type="text" id="nama" value="{{ old('nama', optional($ibu)->nama) }}" minlength="1" maxlength="30" required="true" placeholder="Ketik nama disini...">
        {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tgl_lahir') ? 'has-error' : '' }}">
    <label for="tgl_lahir" class="col-md-2 control-label">Tgl Lahir</label>
    <div class="col-md-10">
        <input class="form-control" name="tgl_lahir" type="date" id="tgl_lahir" value="{{ old('tgl_lahir', optional($ibu)->tgl_lahir) }}" required="true" placeholder="Ketik tgl lahir disini...">
        {!! $errors->first('tgl_lahir', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
    <label for="no_hp" class="col-md-2 control-label">No Hp</label>
    <div class="col-md-10">
        <input class="form-control" name="no_hp" type="tel" pattern="(\+62|62|0)8[1-9][0-9]{6,9}$" id="no_hp" value="{{ old('no_hp', optional($ibu)->no_hp) }}" minlength="1" maxlength="13" required="true" placeholder="Ketik no hp disini...">
        {!! $errors->first('no_hp', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
    <label for="alamat" class="col-md-2 control-label">Alamat</label>
    <div class="col-md-10">
        <input class="form-control" name="alamat" type="text" id="alamat" value="{{ old('alamat', optional($ibu)->alamat) }}" minlength="1" maxlength="60" required="true" placeholder="Ketik alamat disini...">
        {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('wilayah_kerjas_id') ? 'has-error' : '' }}">
    <label for="wilayah_kerjas_id" class="col-md-2 control-label">Wilayah Kerjas</label>
    <div class="col-md-10">
        <select class="form-control" id="wilayah_kerjas_id" name="wilayah_kerjas_id" required="true">
        	    <option value="" style="display: none;" {{ old('wilayah_kerjas_id', optional($ibu)->wilayah_kerjas_id ?: '') == '' ? 'selected' : '' }} disabled selected>Pilih wilayah kerja</option>
        	@foreach ($WilayahKerjas as $key => $WilayahKerja)
			    <option value="{{ $key }}" {{ old('wilayah_kerjas_id', optional($ibu)->wilayah_kerjas_id) == $key ? 'selected' : '' }}>
			    	{{ $WilayahKerja }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('wilayah_kerjas_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('id_telegram') ? 'has-error' : '' }}">
    <label for="id_telegram" class="col-md-2 control-label">Id Telegram (jika ada)</label>
    <div class="col-md-10">
        <input class="form-control" name="id_telegram" type="number" id="id_telegram" value="{{$idtele}}" maxlength="40" placeholder="Ketik id telegram disini...">
        {!! $errors->first('id_telegram', '<p class="help-block">:message</p>') !!}
    </div>
</div>

