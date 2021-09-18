@extends('web.layout.default')
@section('Title','Test list')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">{{ $title  ?? 'N/A' }}</h3>
                    <h4> {{ Session::get('site_name') }} </h4>
                </div>
            </div>
        </div>
        <div class="col-lg-9   grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-striped mydata-table ">
                            
                            <tbody>


                                <tr>
                                    <td>Employee Name</td>
                                    <td >{{ $item->customer->first_name.' '.$item->customer->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Employee Email</td>
                                    <td >{{ $item->customer->email }}</td>
                                </tr>
                                <tr>
                                    <td>Employee Phone</td>
                                    <td>{{ $item->customer->phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Test ID</td>
                                    <td>{{ $item->package_number}}

                                    <a target="_blank" href="{{ route('employee.package.printbarcode',$item->id) }}" class="btn btn-sm btn-info p-2">
                                            Print Barcode
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    @if (Session::get('role') == 10)
                                    <td>Site </td>
                                    @endif
                                    @if (Session::get('role') == 10)
                                    <td>{{ $item->Site->name ?? '-' }}</td>

                                    @endif
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td class="font-weight-medium">
                                        <a href="#" class="btn btn-sm btn-warning">{{ $item->package_status }}</a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Test Requested On</td>
                                    <td> {{ date('d/m/Y',strtotime($item->created_at)) }} <br>
                                        <small>{{ date('h:m A',strtotime($item->created_at)) }}</small> </td>
                                    </tr>
                                </tr>
                                <tr>
                                    <td>Approved On</td>
                                    <td> {{ date('d/m/Y',strtotime($item->approved_at)) }} <br>
                                        <small>{{ date('h:m A',strtotime($item->approved_at)) }}</small> </td>
                                    </tr>
                                </tr>

                            </tbody>
                        </table>
                        <!-- <a class="btn btn-success mt-5" href="{{ route('employee.package.approve',$item->id) }}">Approve Request</a> -->
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('employee.customeraddlogic') }}" class="pt-3">
    @csrf
    {{-- {!! Form::open(['method'=> 'post','route' => ['employee.customeraddlogic'],['class' => 'pt-3']]) !!} --}}

    <div class="form-group">
        <input type="text" value="{{ old('firstname') }}" class="form-control form-control-lg" id="firstname" placeholder="First Name" required name="firstname">
    </div>
    <div class="form-group">
        <input type="text" value="{{ old('lastname') }}" class="form-control form-control-lg" id="lastname" placeholder="Last Name" required name="lastname">
    </div>
    <div class="form-group">
        <input type="date" value="{{ old('dob') }}" class="form-control form-control-lg" id="dob" placeholder="Date of birth" required name="dob">
    </div>
    <div class="form-group">
        <input type="email" value="{{ old('email') }}" class="form-control form-control-lg" id="email" placeholder="Email Address" required name="email">
    </div>
    <div class="form-group">
        <input type="phone" value="{{ old('phone') }}" class="form-control form-control-lg" id="phone" placeholder="Phone Number" required name="phone">
    </div>


    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Add Customer</button>
    </div>




</form>
    </div>
</div>
@endsection
