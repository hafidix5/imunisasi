
<div class="form-group {{ $errors->has('jenis') ? 'has-error' : '' }}">
    <label for="jenis" class="col-md-2 control-label">Jenis</label>
    <div class="col-md-10">
        <input class="form-control" name="jenis" type="text" id="jenis" value="{{ old('jenis', optional($pesans)->jenis) }}" minlength="1" maxlength="20" required="true" placeholder="Enter jenis here...">
        {!! $errors->first('jenis', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pesan') ? 'has-error' : '' }}">
    <label for="pesan" class="col-md-2 control-label">Pesan</label>
    <div class="col-md-10">
        <input class="form-control" name="pesan" type="text" id="pesan" value="{{ old('pesan', optional($pesans)->pesan) }}" minlength="1" maxlength="160" required="true" placeholder="Enter pesan here...">
        {!! $errors->first('pesan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

