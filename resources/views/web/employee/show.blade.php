@extends('web.layout.default')
@section('Title','Show ')

<style>
    .container-fluid.icard {
        padding: 50px;
        /* height: 100vh; */
        width: 100%;
        /* display: flex; */
        background-color: #e6ebe0;
        flex-direction: row;
        flex-flow: wrap;
    }

    .font {
        height: 375px;
        width: 250px;
        position: relative;
        border-radius: 10px;
    }

    .top {
        height: 20%;
        width: 100%;
        background-color: #8338ec;
        position: relative;
        z-index: 5;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .bottom {
        height: 80%;
        width: 100%;
        background-color: white;
        position: relative;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    .top img {
        height: 100px;
        width: 100px;
        background-color: #e6ebe0;
        border-radius: 10px;
        position: absolute;
        top: 30px;
        left: 75px;
    }

    .bottom p {
        position: relative;
        top: 60px;
        text-align: center;
        text-transform: capitalize;
        font-weight: bold;
        font-size: 20px;
        text-emphasis: spacing;
    }

    .bottom .desi {
        font-size: 12px;
        color: grey;
        font-weight: normal;
    }

    .bottom .no {
        font-size: 15px;
        font-weight: normal;
    }

    .barcode img {
        height: 65px;
        width: 65px;
        text-align: center;
        margin: 5px;
    }

    .barcode {
        text-align: center;
        position: relative;
        top: 70px;
    }

    .back {
        height: 375px;
        width: 250px;
        border-radius: 10px;
        background-color: #8338ec;
    }

    .qr img {
        height: 80px;
        width: 100%;
        margin: 20px;
        background-color: white;
    }

    .Details {
        color: white;
        text-align: center;
        padding: 10px;
        font-size: 25px;
    }

    .details-info {
        color: white;
        text-align: left;
        padding: 5px;
        line-height: 20px;
        font-size: 16px;
        text-align: center;
        margin-top: 20px;
        line-height: 22px;
    }

    .logo {
        height: 40px;
        width: 150px;
        padding: 40px;
    }

    .logo img {
        height: 100%;
        width: 100%;
        color: white;
    }

    .padding {
        padding-right: 20px;
    }

    @media screen and (max-width:400px) {
        .container {
            height: 130vh;
        }

        .container .front {
            margin-top: 50px;
        }
    }

    @media screen and (max-width:600px) {
        .container {
            height: 130vh;
        }

        .container .front {
            margin-top: 50px;
        }
    }

</style>

@section('main')


<div class="container-fluid icard">
    <div class="row">
        <div class="col-lg-4 col-12   grid-margin stretch-card">
            <div class="padding emp-card text-center">
                <div class="font">
                    <div class="top">
                        <img src="{{ $item->image }}">
                    </div>
                    <div class="bottom">
                        <p>{{ $item->name }}</p>
                        <p class="desi">{{ $item->email }}</p>
                        <div style="width:100px; height:100px; margin:auto;" id="qrcode" class="barcode">

                        </div>
                        <br>
                        <p class="no"> {{ $item->phone }}</p>
                        <p class="no">ID : {{ $item->EmployeeID() }}</p>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-lg-8 col-12  grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <a data-toggle="modal" data-target="#exampleModal" class="btn btn-info ">
                                <i class="ti-truck"></i> Covid Test </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a href="{{ route('admin.employee.history.screening',$item->id) }}" class="btn btn-primary"><i class="ti-timer"></i> Screening history</a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a href="{{ route('admin.employee.history.test',$item->id) }}" class="btn btn-primary"><i class="ti-timer"></i> Tests</a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="btn btn-info"><i class="ti-check-box"></i> Valid up To {{ $item->test_expire_date ?? 'PENDING' }} </a>
                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <div class="col-7 bg-{{ ($item->current_test_status == 'POSITIVE') ? 'danger' : 'success'  }} rounded text-center p-4 mt-4">
                            <span class="h3 text-light"> Test : {{ $item->current_test_status ?? 'PENDING'   }} </span>
                        </div>
                        <div class="col-7 bg-{{ ($item->risk_level == 'HIGH') ? 'danger' : 'success'  }} rounded text-center  p-4 mt-4">

                            <span class="h3 text-light"> Screening : Risk  {{ $item->risk_level ?? 'PENDING' }} </span>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>

    <div class="row mt-4">
        <div class="col-8  grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table  table-striped  ">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($screenings as $sitem)

                            <tr>
                                <td>
                                    <p  data-toggle="tooltip" data-placement="top" title="{{  $sitem->Questions->question_text }}" > Question ({{ $sitem->question_id }}) </p>
                                </td>
                                <td>{{ $sitem->Answers() }}</td>

                                <td> {{ date('d/m/Y',strtotime($sitem->created_at)) }} <br>
                                    <small>{{ date('h:m A',strtotime($sitem->created_at)) }}</small> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4  grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table  table-striped ">
                        <thead>
                            <tr>
                                <th>Temperature</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($temp as $titem)

                            <tr>
                               <td> {{ $titem->temperature }} <small>(in Celcius)</small></td>

                                <td> {{ date('d/m/Y',strtotime($titem->created_at)) }} <br>
                                    <small>{{ date('h:m A',strtotime($titem->created_at)) }}</small> </td>
                            </tr>





                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12  grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table  table-striped  ">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Result</th>
                                <th>Bar Code</th>
                                <th>Second Bar Code</th>
                                <th>Genes</th>
                                <th>S Gene</th>
                                <th>N Gene</th>
                                <th>ORF 1 AB</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($test as $value)

                            <tr>
                                <td> {{ date('d/m/Y',strtotime($value->created_at)) }} <br>
                                    <small>{{ date('h:m A',strtotime($value->created_at)) }}</small>
                                 </td>
                                <td  ><span class="badge badge-{{  $value->ReportLable() }}" > {{ $value->Report() }}</span> </td>
                                <td>{{ $value->package_number }}</td>
                                <td>{{ $value->secondary_barcode }}</td>
                                <td>{{ $value->genes ?? '-' }}</td>
                                <td>{{ $value->s_gene ?? '-' }}</td>
                                <td>{{ $value->n_gene ?? '-' }}</td>
                                <td>{{ $value->orf_1_ab ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $item->name }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['route' =>'admin.package.assign','method' => 'post']) !!}
            <div class="modal-body">

                {!! Form::hidden('site_id',$item->AssigneSite()->site->name ?? 0 , []) !!}
                {!! Form::hidden('employee_id',$item->id , []) !!}
                {!! Form::hidden('assign_by',Session::get('user_id') , []) !!}
                {!! Form::hidden('site_id', Session::get('site_id') ?? 0, []) !!}
                <div class="form-group row">
                    <label for="emp_name" class="col-sm-3 col-form-label">Bar Code</label>
                    <div class="col-sm-9">
                        {!! Form::text('barcode',null, ['class'=> 'form-control' ,'placeholder' => 'BarCode','autofocus'=> 'autofocus']) !!}

                    </div>
                </div>
                <div class="form-group row">
                    <label for="emp_name" class="col-sm-3 col-form-label">Secondary BarCode</label>
                    <div class="col-sm-9">
                        {!! Form::text('secondary_barcode',null, ['class'=> 'form-control' ,'placeholder' => 'Secondary BarCode','autofocus'=> 'autofocus']) !!}

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script type="text/javascript">
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 100
        , height: 100
    });

    function makeCode() {
        qrcode.makeCode('{{ base64_encode($item->id) }}');
    }

    makeCode();

</script>

@endsection
