
    <div class="form-group row">
        <label for="emp_contact" class="col-sm-3 col-form-label">Laboratories</label>
        <div class="col-sm-9">
            {!! Form::select('lab_id', Arr::pluck($labs,'name','id'), null, ['class'=> 'form-control' ,'placeholder' => 'Plesae select Laboratory  ' ,'required' => 'required']) !!}
        </div>
    </div>
    {{-- <div class="form-group row">
        <label for="project_start" class="col-sm-3 col-form-label"> Date </label>
        <div class="col-sm-9">
                  {!! Form::date('date', null, ['class'=> 'form-control' ,'placeholder' => 'Please Select Date','required' => 'required']) !!}
        </div>
    </div> --}}
