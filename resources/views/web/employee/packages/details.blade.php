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
                            <!-- <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Employee Name</th>
                                    <th>Employee Email</th>
                                    <th>Employee Phone</th>
                                    <th>Test ID</th>
                                    @if (Session::get('role') == 10)
                                    <th>Site </th>
                                    @endif
                                    <th>Status</th>
                                    <th>Test Requested On</th>
                                </tr>
                            </thead> -->
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
                                    <td>
                                        <span id="package_number">{{ $item->package_number??'-'}}</span>
                                        
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
                                        <a href="#" class="btn btn-sm btn-danger">{{ $item->package_status }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Test Requested On</td>
                                    <td> {{ date('d/m/Y',strtotime($item->created_at)) }} <br>
                                        <small>{{ date('h:m A',strtotime($item->created_at)) }}</small> </td>
                                    </tr>
                                </tr>

                            </tbody>
                        </table>
                        <a class="btn btn-success mt-5" href="{{ route('employee.package.approve',$item->id) }}">Approve Request</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

