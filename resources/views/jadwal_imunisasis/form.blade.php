
<div class="form-group {{ $errors->has('jenis_imunisasis_id') ? 'has-error' : '' }}">
    <label for="jenis_imunisasis_id" class="col-md-2 control-label">Jenis Imunisasis</label>
    <div class="col-md-10">
        <select class="form-control" id="jenis_imunisasis_id" name="jenis_imunisasis_id" required="true">
        	    <option value="" style="display: none;" {{ old('jenis_imunisasis_id', optional($jadwalImunisasi)->jenis_imunisasis_id ?: '') == '' ? 'selected' : '' }} disabled selected>Pilih jenis imunisasi</option>
        	@foreach ($JenisImunisasis as $key => $JenisImunisasi)
			    <option value="{{ $key }}" {{ old('jenis_imunisasis_id', optional($jadwalImunisasi)->jenis_imunisasis_id) == $key ? 'selected' : '' }}>
			    	{{ $JenisImunisasi }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('jenis_imunisasis_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tempat') ? 'has-error' : '' }}">
    <label for="tempat" class="col-md-2 control-label">Tempat</label>
    <div class="col-md-10">
        <input class="form-control" name="tempat" type="text" id="tempat" value="{{ old('tempat', optional($jadwalImunisasi)->tempat) }}" minlength="1" maxlength="50" required="true" placeholder="Ketik tempat disini...">
        {!! $errors->first('tempat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tanggal') ? 'has-error' : '' }}">
    <label for="tanggal" class="col-md-2 control-label">Tanggal</label>
    <div class="col-md-10">
        <input class="form-control" name="tanggal" type="date" id="tanggal" value="{{ old('tanggal', optional($jadwalImunisasi)->tanggal) }}" required="true" placeholder="Ketik tanggal disini...">
        {!! $errors->first('tanggal', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('waktu_pemberian') ? 'has-error' : '' }}">
    <label for="waktu_pemberian" class="col-md-2 control-label">Waktu Pemberian</label>
    <div class="col-md-10">
        <input class="form-control" name="waktu_pemberian" type="date" id="waktu_pemberian" value="{{ old('waktu_pemberian', optional($jadwalImunisasi)->waktu_pemberian) }}" placeholder="Ketik waktu pemberian disini...">
        {!! $errors->first('waktu_pemberian', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('berat_badan') ? 'has-error' : '' }}">
    <label for="berat_badan" class="col-md-2 control-label">Berat Badan</label>
    <div class="col-md-10">
        <input class="form-control" name="berat_badan" type="number" id="berat_badan" value="{{ old('berat_badan', optional($jadwalImunisasi)->berat_badan) }}" min="-9" max="9" placeholder="Ketik berat badan disini...">
        {!! $errors->first('berat_badan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('panjang_badan') ? 'has-error' : '' }}">
    <label for="panjang_badan" class="col-md-2 control-label">Panjang Badan</label>
    <div class="col-md-10">
        <input class="form-control" name="panjang_badan" type="number" id="panjang_badan" value="{{ old('panjang_badan', optional($jadwalImunisasi)->panjang_badan) }}" min="-9" max="9" placeholder="Ketik panjang badan disini...">
        {!! $errors->first('panjang_badan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('suhu') ? 'has-error' : '' }}">
    <label for="suhu" class="col-md-2 control-label">Suhu</label>
    <div class="col-md-10">
        <input class="form-control" name="suhu" type="number" id="suhu" value="{{ old('suhu', optional($jadwalImunisasi)->suhu) }}" min="-9" max="9" placeholder="Ketik suhu disini...">
        {!! $errors->first('suhu', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">Status</label>
    <div class="col-md-10">
        <input class="form-control" name="status" type="text" id="status" value="{{ old('status', optional($jadwalImunisasi)->status) }}" maxlength="30" placeholder="Ketik status disini...">
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
    <label for="keterangan" class="col-md-2 control-label">Keterangan</label>
    <div class="col-md-10">
        <input class="form-control" name="keterangan" type="text" id="keterangan" value="{{ old('keterangan', optional($jadwalImunisasi)->keterangan) }}" maxlength="50" placeholder="Ketik keterangan disini...">
        {!! $errors->first('keterangan', '<p class="help-block">:message</p>') !!}
    </div>
</div>



