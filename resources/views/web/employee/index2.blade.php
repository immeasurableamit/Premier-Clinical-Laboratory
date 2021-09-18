@extends('web.layout.default')
@section('Title','Employee list')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Employees list</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mydata-table ">
                            <thead>
                                <tr>
                                    <th>Employe ID</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>Phone Number</th>
                                    {{-- <th>End Date</th> --}}
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)

                                <tr>
                                    <td>{{ $item->Employee->EmployeeID() }}
                                        <br>
                                    <small>
                                       <a target="_blank" href="{{ route('admin.manage.print',$item->Employee->id) }}">Print Card</a>
                                    </small>
                                    </td>
                                    <td class="py-1">{{ $item->Employee->name }}</td>
                                    <td>{{ $item->Employee->email }}</td>
                                    <td>{{ $item->Employee->phone }}</td>
                                    {{-- <td> --}}

                                        {{-- <small>
                                             Till : {{ $item->end_date }}
                                         </small> --}}

                                    {{-- </td> --}}
                                    {{-- <td>{{ $item->Status() }}</td> --}}

                                    {{-- <td> --}}
                                        {{-- <a href="{{ route('admin.manage.screening',$item->Employee->id) }}" class=" d-inline btn btn-sm btn-info mr-2 p-2">
                                            <i class="mdi mdi-eye"></i> Screening
                                        </a> --}}
                                        {{-- <a href="{{ route('admin.manage.details',$item->Employee->id) }}" class=" d-inline btn btn-sm  btn-info mr-2 p-2">
                                            <i class="mdi mdi-eye"></i> View
                                        </a> --}}


                                    {{-- </td> --}}
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
