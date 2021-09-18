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
        <div class="col-md-4  grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Employee Details</h5>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div   class="profile-img p-4">
                                <img width="100%"   class="img-responsive" src="{{ $item->image }}" alt="">
                            </div>
                            <div class="details py-3">
                               <h3 class="name" >
                                    <i class="ti ti-user"></i>
                                   <span class="p-2" > {{ $item->name }}</span>

                                </h3>
                               <h6 class="email" >
                                   <i class="ti ti-email"></i>
                                   <span class="p-2" > {{ $item->email }}</span>
                                </h6>
                               <h6 class="phone" >
                                    <i class="ti ti-headphone-alt"></i>
                                   <span class="p-2" > {{ $item->phone }}</span>
                               </h6>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Screening Questions</h5>

                    @foreach ($items as $qus)
                    <div class="question">
                        @if ( $qus->questions)

                        <h6><strong>Question ({{ $qus->questions->id }}) : </strong></h6>
                        <h6> {{ $qus->questions->question_text }} </h6>
                        <strong>Answer :</strong>
                        <span class="badge badge-{{ $qus->AnswersLables() }}" > {{ $qus->Answers() }}</span>
                        <hr>
                        @else
                        {{-- <h6><strong>Question ({{ $qus->id }}) : </strong></h6>
                        <h6> Heading  </h6>
                        <strong>Answer :</strong>
                        <span class="badge badge-{{ $qus->AnswersLables() }}" > {{ $qus->Answers() }}</span>
                        <hr> --}}
                        @endif
                    </div>
                    @endforeach


                    @if ($temperature)
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="emp_name" class="col-sm-12 col-form-label">
                                <span class="h5 font-weight-bold ">Temperature<small>(in Celcius)</small>: </span>
                                 <span class="h5 badge badge-info" >  {{ $temperature->temperature ?? 'N/A' }} <sup> o</sup>C </span>
                            </label>
                        </div>
                    </div>
                    <hr>
                     <a  href="{{ route('admin.manage.details',$item->id) }}"  class="btn btn-info"> Next </a>
                    @else

                    {!! Form::open(['route' => 'admin.manage.temp.store','method' => 'post']) !!}
                     <div class="form-group row">
                        <label for="emp_name" class="col-sm-4 col-form-label"><strong>Temperature <small>(in Celcius)</small> : </strong></label>
                        <div class="col-sm-6">
                            {!! Form::hidden('user_id', $item->id) !!}
                            {!! Form::number('temperature',null, ['class'=> 'form-control' ,'placeholder' => 'Eg 95','required' => 'required','step' =>"0.01"]) !!}
                        </div>
                    </div>

                     <button  type="submit" class="btn btn-info"> Save </button>


                    {!! Form::close() !!}
                    @endif



                    <hr>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
