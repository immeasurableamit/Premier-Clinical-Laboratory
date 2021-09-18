@extends('web.layout.default')
@section('Title','Admins list')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Admins list</h3>
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
                                        Admin name
                                    </th>
                                    <th>
                                        Admin email
                                    </th>
                                    <th>
                                         Assigned Location
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
                                        {{ $item->User->id }}
                                    </td>
                                    <td class="py-1">
                                        {{ $item->User->name }}
                                    </td>
                                    <td>
                                        {{ $item->User->email }}
                                    </td>
                                    <td>
                                        {{ $item->Site->name }}

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.site-admin.edit',$item->User->id) }}" class=" d-inline btn btn-sm p-2 btn-warning">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </a>
                                        {!! Form::open([
                                            'class'=>'delete d-inline ml-2',
                                            'url'  => route('admin.site-admin.destroy', $item->User->id),
                                            'method' => 'DELETE',

                                            ])
                                        !!}
                                        <button type="button"  class="  d-inline btn btn-sm p-2 btn-info">

                                            <i class="mdi mdi-delete"></i> Delete

                                        </button>
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
