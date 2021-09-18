<div class="form-group row">
    <label for="site_name" class="col-sm-3 col-form-label">Location name</label>
    <div class="col-sm-9">
        {!! Form::text('name', null, ['class'=> 'form-control' ,'placeholder' => 'Location Name']) !!}
        {{-- <input type="text" class="form-control" id="site_name" name="site_name" placeholder="Site name"> --}}
    </div>
</div>
<div class="form-group row">
    <label for="site_address" class="col-sm-3 col-form-label">Address</label>
    <div class="col-sm-9">
        {!! Form::text('address', null, ['class'=> 'form-control' ,'placeholder' => 'Address']) !!}

        {{-- <input type="text" class="form-control" id="site_address" name="site_address" placeholder="Site address"> --}}
    </div>
</div>
