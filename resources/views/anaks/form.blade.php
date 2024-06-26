
<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
    <label for="nama" class="col-md-2 control-label">Nama</label>
    <div class="col-md-10">
        <input class="form-control" name="nama" type="text" id="nama" value="{{ old('nama', optional($anak)->nama) }}" minlength="1" maxlength="30" required="true" placeholder="Ketik nama disini...">
        {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tgl_lahir') ? 'has-error' : '' }}">
    <label for="tgl_lahir" class="col-md-2 control-label">Tgl Lahir</label>
    <div class="col-md-10">
        <input class="form-control" name="tgl_lahir" type="date" id="tgl_lahir" value="{{ old('tgl_lahir', optional($anak)->tgl_lahir) }}" required="true" placeholder="Ketik tgl lahir disini...">
        {!! $errors->first('tgl_lahir', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
    <label for="jenis_kelamin" class="col-md-2 control-label">Jenis Kelamin</label>
    <div class="col-md-10">
        
        {!! $errors->first('jenis_kelamin', '<p class="help-block">:message</p>') !!}
        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required="true">
            @if (optional($anak)->jenis_kelamin == 'l')
                <option value="{{ optional($anak)->jenis_kelamin }}">Laki-Laki</option>
            @else
                @if (optional($anak)->jenis_kelamin == 'p')
                    <option value="{{ optional($anak)->jenis_kelamin }}">Perempuan</option>
                @else
                    <option value="">Pilih Jenis Kelamin</option>
                @endif

            @endif
            <option value="l">Laki-Laki</option>
            <option value="p">Perempuan</option>
        </select>
    
    </div>
</div>

<div class="form-group {{ $errors->has('ibus_id') ? 'has-error' : '' }}">
    <label for="ibus_id" class="col-md-2 control-label">Ibu</label>
    <div class="col-md-10">
        <select class="form-responsive"  style="min-width:30%;max-width:90%" id="ibus_id" name="ibus_id" required="true">
        	    <option value="" style="display: none;" {{ old('ibus_id', optional($anak)->ibus_id ?: '') == '' ? 'selected' : '' }} disabled selected>Pilih Ibu</option>
        	@foreach ($Ibus as $key => $Ibu)
			    <option value="{{ $key }}" {{ old('ibus_id', optional($anak)->ibus_id) == $key ? 'selected' : '' }}>
			    	{{ $Ibu }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('ibus_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

