@extends('web.layout.default')
@section('Title','Test list')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Lookup Customer</h3>
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

                                    <th>Custmer Name</th>
                                    <th>Test ID</th>
                                    <th>Test Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Result</th>
                                    <th>Action</th>
                                    @if (session::get('role') ==1 )
                                    <th>Change Status</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)
                                <tr>
                                    <td >{{ $item->Customer->first_name .' '. $item->Customer->last_name }}</td>
                                    <td >{{ $item->package_number ?? 'N/A' }}</td>


                                    <td > <span class="badge badge-{{ $item->TypeLable() }}"> {{ $item->Type() }} </span> </td>
                                <td >{{ $item->book_date }} </td>
                                    <td > <span class="badge badge-info"> {{ $item->package_status }} </span> </td>
                                    <td > <span class="badge badge-{{ $item->ReportLable() }}"> {{ $item->Report() }} </span> </td>
                                    <td>
                                        @if ($item->Report() == 'PENDING')
                                            <span href="" class=" " >N/A </span>
                                        @else
                                        <a target="_blank" href="{{ route('employee.result.download',$item->id) }}" class=" " >Print Report </a>
                                        @endif
                                    </td>
                                    @if (session::get('role')==1)
                                    @if ($item->package_status ===  'Completed')
                                    <td>
                                        <button data-link="{{ route('admin.positive',$item->id) }}" class="btn btn-sm btn-danger p-2 change">
                                            Positive
                                        </button>
                                        <button data-link="{{ route('admin.negative',$item->id) }}" class="btn btn-sm btn-success p-2 change">
                                            Negative
                                        </button>
                                    </td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                     @endif
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
