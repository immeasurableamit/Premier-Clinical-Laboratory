
<div class="form-group row">
    <label for="admin_name" class="col-sm-3 col-form-label">Admin name</label>
    <div class="col-sm-9">
        {!! Form::text('name',$item->User->name ?? null, ['class'=> 'form-control' ,'placeholder' => 'Admin Name']) !!}
        {{-- <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="Admin name" required> --}}
    </div>
</div>
<div class="form-group row">
    <label for="admin_email" class="col-sm-3 col-form-label">Admin email</label>
    <div class="col-sm-9">
        {!! Form::email('email', $item->User->email ?? null, ['class'=> 'form-control' ,'placeholder' => 'admin@site.com']) !!}

        {{-- <input type="email" class="form-control" id="admin_email" name="email" placeholder="admin@site.com" required> --}}
    </div>
</div>
<div class="form-group row">
    <label for="site_for_admin" class="col-sm-3 col-form-label">Assign Location </label>
    <div class="col-sm-9">
        {!! Form::select('site_id', Arr::pluck($Sites,'name','id'), $item->site_id ?? null, ['class'=> 'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="admin_password" class="col-sm-3 col-form-label">Admin password</label>
    <div class="col-sm-9">
        {!! Form::password('password', ['class'=> 'form-control' ,'placeholder' => '123456']) !!}

        {{-- <input type="password" class="form-control" id="admin_password" name="admin_password" required> --}}
    </div>
</div>
<div class="form-group row">
    <label for="admin_c_password" class="col-sm-3 col-form-label">Confirm password</label>
    <div class="col-sm-9">
        {!! Form::password('password_confirmation', ['class'=> 'form-control' ,'placeholder' => 'confirm your password']) !!}

        {{-- <input type="password" class="form-control" id="admin_c_password" name="admin_c_password" required> --}}
    </div>
</div>
