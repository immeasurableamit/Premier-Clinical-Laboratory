@extends('web.layout.default')
@section('Title','Test list')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Complated Tests List</h3>
                    <h4>( {{ Session::get('site_name') }} )</h4>

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
                                    <th>Photo</th>
                                    <th>Employee Name</th>
                                    <th>Employee ID</th>
                                    <th>Test ID</th>
                                    @if (Session::get('role') == 10)
                                    <th>Site </th>
                                    @endif
                                    <th>Status</th>
                                    <th>Sample collected on</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)

                                <tr>
                                    <td class="py-1">
                                        <img src="{{ $item->Employee->image }}" alt="image" />
                                    </td>
                                    <td >{{ $item->Employee->name }}</td>
                                    <td >{{ $item->Employee->EmployeeID() }}</td>

                                    <td>{{ $item->package_number}}</td>
                                    @if (Session::get('role') == 10)
                                    <td>{{ $item->Site->name }}</td>

                                    @endif
                                    <td class="font-weight-medium">
                                        <a href="#" class="btn btn-sm btn-{{ $item->ReportLable() }}">{{ $item->Report() }}</a>
                                    </td>
                                    <td> {{ date('d/m/Y',strtotime($item->created_at)) }} <br>
                                        <small>{{ date('h:m A',strtotime($item->created_at)) }}</small> </td>
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
