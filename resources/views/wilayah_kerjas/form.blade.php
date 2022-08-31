
<div class="form-group {{ $errors->has('jenis') ? 'has-error' : '' }}">
    <label for="jenis" class="col-md-2 control-label">Jenis</label>
    <div class="col-md-10">
        <input class="form-control" name="jenis" type="text" id="jenis" value="{{ old('jenis', optional($wilayahKerjas)->jenis) }}" minlength="1" maxlength="20" required="true" placeholder="Ketik jenis disini...">
        {!! $errors->first('jenis', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
    <label for="nama" class="col-md-2 control-label">Nama</label>
    <div class="col-md-10">
        <input class="form-control" name="nama" type="text" id="nama" value="{{ old('nama', optional($wilayahKerjas)->nama) }}" minlength="1" maxlength="30" required="true" placeholder="Ketik nama disini...">
        {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
    </div>
</div>

