@extends('web.layout.default')
@section('Title','Test list')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Requests
                          <small>(Sample not taken)</small>
                    </h3>


                </div>
                {{-- <div class="col-12 mt-2">
                    <div class="d-flex">
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                            <button class="btn btn-sm btn-light bg-warning dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="mdi mdi-calendar"></i> 10 Jan 2021
                       </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                <a class="dropdown-item" href="#"><i class="mdi mdi-calendar"></i> 10 Jan 2021</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-calendar"></i> 10 Jan 2021</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-calendar"></i> 10 Jan 2021</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-calendar"></i> 10 Jan 2021</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-striped mydata-table ">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Test Request ID</th>
                                    @if (Session::get('role') == 10)
                                    <th>Site </th>
                                    @endif
                                    <th>Test Requested On</th>
                                    <th>View Details</th>
                                    <th>Approve</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)

                                <tr>
                                    <td >{{ $item->customer->first_name.' '.$item->customer->last_name }}</td>

                                    <td>{{ $item->package_number}}</td>
                                    @if (Session::get('role') == 10)
                                    <td>{{ $item->Site->name }}</td>

                                    @endif
                                    <td> {{ date('d/m/Y',strtotime($item->created_at)) }} <br>
                                        <small>{{ date('h:m A',strtotime($item->created_at)) }}</small> </td>
                                    <td>
                                        <a href="{{ route('employee.package.details',$item->id) }}" class="btn btn-sm btn-info p-2">
                                            <i class="mdi mdi-eye"></i> Details
                                        </a>


                                    </td>
                                    <td>

                                        <a class="btn btn-success p-2" href="{{ route('employee.package.approve',$item->id) }}">Approve Request</a>
                                    </td>
                                    </tr>





                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
