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
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)
                                <tr>
                                    <td class="py-1">
                                        <img src="{{ $item->employee->image }}" alt="image" />
                                    </td>
                                    <td >{{ $item->employee->name }}</td>
                                    <td >{{ $item->employee->EmployeeID() }}</td>
                                    <td><a href="{{ route('admin.risk.down',$item->employee->id) }}" class=" p-2 btn btn-info" >Clear Risks </a></td>

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
