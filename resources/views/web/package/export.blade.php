@extends('web.layout.default')
@section('Title','Test list')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">List of employees whose samples are collected</h3>
                    <h4>( {{ Session::get('site_name') }} )</h4>

                </div>
                <div class="col-12 col-xl-3 text-center">
                    <a href="{{ route('admin.package.export.excel') }}">
                        <div class="col-12 stretch-card">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <h4 class="mb-0"> <i class="mdi mdi-file-excel"> </i> Export excel</h4>
                                </div>
                            </div>
                        </div>
                    </a>
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
                                        Photo
                                    </th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Sample ID
                                    </th>
                                    @if (Session::get('role') == 10)
                                    <th>Site </th>

                                    @endif
                                    <th>
                                        Sample collected on
                                        <br>(Time)
                                    </th>



                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)

                                <tr>
                                    <td class="py-1">
                                        <img src="{{ $item->Employee->image }}" alt="image" />
                                    </td>
                                    <td >{{ $item->Employee->EmployeeID() }}</td>
                                    <td >{{ $item->Employee->name }}</td>
                                    <td >{{ $item->package_number }}</td>

                                    @if (Session::get('role') == 10)
                                    <td>{{ $item->Site->name }}</td>

                                    @endif


                                    <td> {{ date('d/m/Y',strtotime($item->created_at)) }} <br>
                                    <small>{{ date('h:i A',strtotime($item->created_at)) }}</small> </td>

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
