@extends('web.layout.default')
@section('Title','Test list')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">{{ $title  ?? 'N/A' }}</h3>
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

                                    <th>Location</th>
                                    <th>Test Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Result</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)
                                <tr>
                                    <td >{{ $item->SiteName() }}
                                    
                                    <small> Address : {{ $item->SiteAddress()}} </small></td>
                                    <td > <span class="badge badge-{{ $item->TypeLable() }}"> {{ $item->Type() }} </span> </td>
                                <td >{{ $item->book_date }} </td>
                                    <td > <span class="badge badge-info"> {{ $item->package_status }} </span> </td>
                                    <td > <span class="badge badge-{{ $item->ReportLable() }}"> {{ $item->Report() }} </span> </td>
                                    <td>
                                        @if ($item->Report() == 'PENDING')
                                       <span  class=" " >N/A </span>


                                        @else
                                        <a href="{{ route('customer.result.download',$item->id) }}" class=" " >Print Report </s>

                                        @endif


                                    </td>


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
