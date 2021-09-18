
    <div class="form-group row">
        <label for="photo" class="col-sm-12">Employee photo</label>
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
        <label for="emp_name" class="col-sm-3 col-form-label">Employee name</label>
        <div class="col-sm-9">
            {!! Form::text('name',null, ['class'=> 'form-control' ,'placeholder' => 'Employee Name']) !!}

        </div>
    </div>
    <div class="form-group row">
        <label for="emp_contact" class="col-sm-3 col-form-label">Employee contact number</label>
        <div class="col-sm-9">
            {!! Form::text('phone',null, ['class'=> 'form-control' ,'placeholder' => 'Employee contact number']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label for="emp_email" class="col-sm-3 col-form-label">Employee email</label>
        <div class="col-sm-9">

            {!! Form::email('email',null, ['class'=> 'form-control' ,'placeholder' => 'Employee email']) !!}
            </div>
    </div>
    {{-- <div class="form-group row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-6 p-0">
                    <label for="project_start" class="col-sm-12 col-form-label">Project start date
                    </label>
                    <div class="col-sm-12">
                        {!! Form::date('start_date', null, ['class'=> 'form-control' ,'placeholder' => 'Project Start Date']) !!}

                    </div>
                </div>
                <div class="col-6 p-0">
                    <label for="project_end" class="col-sm-12 col-form-label">Project end date
                    </label>
                    <div class="col-sm-12">
                        {!! Form::date('end_date', null, ['class'=> 'form-control' ,'placeholder' => 'Project End Date']) !!}

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
