@extends('web.layout.default')
@section('Title','Locations list')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Locations list</h3>
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
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Location name
                                    </th>
                                    <th>
                                        Location address
                                    </th>
                                    <th>
                                        Total employees
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)

                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td class="py-1">
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->address }}
                                    </td>
                                    <td>
                                        {{ $item->EmployeeCount() }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.site.edit',$item->id) }}" class=" d-inline btn btn-sm p-2 btn-warning">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </a>
                                        {!! Form::open([
                                            'class'=>'delete d-inline ml-2',
                                            'url'  => route('admin.site.destroy', $item->id),
                                            'method' => 'DELETE',

                                            ])
                                        !!}
                                        {{-- <button  class=" d-inline btn btn-sm p-2 btn-info">

                                            <i class="mdi mdi-delete"></i> Delete

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
