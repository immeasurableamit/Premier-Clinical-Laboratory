
       <div class="form-group row">
        <label for="photo" class="col-sm-12">Photo</label>
        <div class="col-sm-12">
            <img src="{{ $item->image ??  asset('assets/images/faces/face11.jpg')  }}" alt="" id="previewHolder" width="120px">

            {{-- {!! Form::file('file', ['id' => 'upload_photo' ,'hidden' => 'hidden'] ) !!} --}}
            <input type="file" name="image" id="upload_photo" hidden>
            <button type="button" class="btn btn-sm btn-primary ml-4 upload_photo">
                Upload/change
            </button>
        </div>
    </div>
    <div class="form-group row">
        <label for="emp_name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            {!! Form::text('name',null, ['class'=> 'form-control' ,'placeholder' => 'Eg. Jone Simth','required' => 'required']) !!}

        </div>
    </div>
    <div class="form-group row">
        <label for="emp_email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">

            {!! Form::email('email',null, ['class'=> 'form-control' ,'placeholder' => 'Eg. jonesimth@example.com' ,'required' => 'required']) !!}
            </div>
    </div>
    <div class="form-group row">
        <label for="emp_contact" class="col-sm-3 col-form-label">Contact No.</label>
        <div class="col-sm-9">
            {!! Form::text('phone',null, ['class'=> 'form-control' ,'placeholder' => 'Eg. 1123456789 | Enter with country code | Plus `+` not required' ,'required' => 'required']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label for="emp_contact" class="col-sm-3 col-form-label">Select Location</label>
        <div class="col-sm-9">
            @if ($item ?? null)
              {!! Form::select('site', Arr::pluck($sites,'name','id'), $item->AssigneSite()->site_id, ['class'=> 'form-control' ,'placeholder' => 'Plesae select location ' ,'required' => 'required']) !!}
            @else
             {!! Form::select('site', Arr::pluck($sites,'name','id'), null, ['class'=> 'form-control' ,'placeholder' => 'Plesae select location ' ,'required' => 'required']) !!}
            @endif

        </div>
    </div>



    {{-- <div class="form-group row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-6 p-0">
                    <label for="project_start" class="col-sm-12 col-form-label">Project start date
                    </label>
                    <div class="col-sm-12">
                        {!! Form::date('project_start', null, ['class'=> 'form-control' ,'placeholder' => 'Project Start Date' ,'required' => 'required']) !!}

                    </div>
                </div>
                <div class="col-6 p-0">
                    <label for="project_end" class="col-sm-12 col-form-label">Project end date
                    </label>
                    <div class="col-sm-12">
                        {!! Form::date('project_end', null, ['class'=> 'form-control' ,'placeholder' => 'Project End Date' ,'required' => 'required']) !!}

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
