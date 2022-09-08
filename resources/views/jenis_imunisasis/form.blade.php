
<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
    <label for="nama" class="col-md-2 control-label">Nama</label>
    <div class="col-md-10">
        <input class="form-control" name="nama" type="text" id="nama" value="{{ old('nama', optional($jenisImunisasi)->nama) }}" minlength="1" maxlength="30" required="true" placeholder="Ketik nama disini...">
        {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('waktu_tepat') ? 'has-error' : '' }}">
    <label for="waktu_tepat" class="col-md-2 control-label">Waktu Tepat</label>
    <div class="col-md-10">
        <input class="form-control" name="waktu_tepat" type="number" id="waktu_tepat" value="{{ old('waktu_tepat', optional($jenisImunisasi)->waktu_tepat) }}" min="-9" max="9" required="true" placeholder="Ketik waktu tepat disini...">
        {!! $errors->first('waktu_tepat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('waktu_telat') ? 'has-error' : '' }}">
    <label for="waktu_telat" class="col-md-2 control-label">Waktu Telat</label>
    <div class="col-md-10">
        <input class="form-control" name="waktu_telat" type="number" id="waktu_telat" value="{{ old('waktu_telat', optional($jenisImunisasi)->waktu_telat) }}" min="-9" max="9" required="true" placeholder="Ketik waktu telat disini...">
        {!! $errors->first('waktu_telat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
    <label for="keterangan" class="col-md-2 control-label">Keterangan</label>
    <div class="col-md-10">
        <input class="form-control" name="keterangan" type="text" id="keterangan" value="{{ old('keterangan', optional($jenisImunisasi)->keterangan) }}" minlength="1" maxlength="30" required="true" placeholder="Ketik keterangan disini...">
        {!! $errors->first('keterangan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

