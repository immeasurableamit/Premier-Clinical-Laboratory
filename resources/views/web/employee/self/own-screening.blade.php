@extends('web.layout.default')
@section('Title','Screening | ' . $item->name)


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Screening </h3>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-4  grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Employee Details</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2">Details</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Image :</td>
                                <td> <img src="{{ $item->image }}" alt=""></td>
                            </tr>
                            <tr>
                                <td scope="row">Name : </td>
                                <th>{{ $item->name }}</th>
                            </tr>
                            <tr>
                                <td scope="row">Email :</td>
                                <th>{{ $item->email }}</th>
                            </tr>
                            <tr>
                                <td scope="row">Phone :</td>
                                <th>{{ $item->phone }}</th>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Screening Questions</h5>
                    {!! Form::open(['route' => 'employee.screening.store','files' => true]) !!}
                    {!! Form::hidden('user_id',session('user_id')) !!}
                    @foreach ($items as $item)
                    <div class="question">
                        {{-- <h4>Sr {{ $item->id }}</h4> --}}
                        <h6><strong>Question ({{ $item->id }}) : </strong></h6>
                        <h6> {{ $item->question_text }} </h6>
                        <strong>Options :</strong>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" required style="position: absolute;" type="radio" name="answer[{{ $item->id}}]" id="inlineRadio1{{ $item->id }}" value="1">
                            <label class="form-check-label" for="inlineRadio1{{ $item->id }}">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" required type="radio"  style="position: absolute;" name="answer[{{ $item->id }}]" id="inlineRadio2{{ $item->id }}" value="2">
                            <label class="form-check-label" for="inlineRadio2{{ $item->id }}">No</label>
                        </div>
                    {!! Form::hidden('question[]', $item->id) !!}


                        <hr>
                    </div>

                    @endforeach


                   {{-- <div class="form-group row">
                        <label for="emp_name" class="col-sm-3 col-form-label"><strong>(Temperature (in Celcius) : </strong></label>
                        <div class="col-sm-6">
                            {!! Form::number('temperature',null, ['class'=> 'form-control' ,'placeholder' => 'Eg 95','required' => 'required','step' =>"0.01"]) !!}

                        </div>
                    </div> --}}
                    <hr>
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <button  type="reset" class="btn btn-light">Cancel</button>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
