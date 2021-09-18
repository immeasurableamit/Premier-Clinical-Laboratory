@extends('web.layout.default')
@section('Title','Employees list')


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
                                    {{-- <th>Test Day</th> --}}
                                    <th>Sites assigned</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)

                                <tr>
                                    <td>{{ $item->EmployeeID() }}
                                        <br>
                                    <small>
                                       <a target="_blank" href="{{ route('admin.employess.print',$item->id) }}">Print Card</a>
                                    </small>
                                    </td>
                                    <td class="py-1">{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    {{-- <td>{{ $item->days }}</td> --}}
                                    <td>

                                        @if ($item->AssigneSite() == null)
                                        <a href="{{ route('admin.employess.edit',$item->id) }}" class=" d-inline btn btn-sm p-2 btn-dark" data-toggle="modal" data-target="#exampleModal-{{ $item->id }}" >
                                            Assign Site
                                        </a>
                                        @else

                                        {{  $item->AssigneSite()->site->name}}
                                         {{-- <br><small>
                                             Till : {{ $item->AssigneSite()->end_date }}
                                         </small> --}}
                                        @endif

                                    </td>
                                    {{-- <td>{{ $item->Status() }}</td> --}}

                                    <td>
                                        {{-- <a href="{{ route('admin.employess.details',$item->id) }}" class=" d-inline btn btn-sm p-2 btn-info mr-2">
                                            <i class="mdi mdi-eye"></i> View
                                        </a> --}}
                                        <a href="{{ route('admin.employess.edit',$item->id) }}" class=" d-inline btn btn-sm p-2 btn-warning">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </a>
                                        {!! Form::open([
                                            'class'=>'delete d-inline ml-2',
                                            'url'  => route('admin.employess.destroy', $item->id),
                                            'method' => 'DELETE',

                                            ])
                                        !!}
                                        {{-- <button  class=" d-inline btn btn-sm p-2 btn-danger">
                                            <i class="mdi mdi-delete"> </i> Delete

                                        </button> --}}
                                        {!! Form::close() !!}
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
