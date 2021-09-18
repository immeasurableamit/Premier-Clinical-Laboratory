@extends('web.layout.default')
@section('Title','Show ')


@section('main')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold"> History Test</h3>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="row mt-4">
                <div class="col-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table  table-striped  ">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Result</th>
                                        <th>Bar Code</th>
                                        <th>Second Bar Code</th>
                                        <th>Genes</th>
                                        <th>S Gene</th>
                                        <th>N Gene</th>
                                        <th>ORF 1 AB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $value)

                                    <tr>
                                        <td> {{ date('d/m/Y',strtotime($value->created_at)) }} <br>
                                            <small>{{ date('h:m A',strtotime($value->created_at)) }}</small>
                                        </td>
                                        <td><span class="badge badge-{{  $value->ReportLable() }}" > {{ $value->Report() }}</span></td>

                                        <td>{{ $value->package_number }}</td>
                                        <td>{{ $value->secondary_barcode }}</td>
                                        <td>{{ $value->genes ?? '-' }}</td>
                                        <td>{{ $value->s_gene ?? '-' }}</td>
                                        <td>{{ $value->n_gene ?? '-' }}</td>
                                        <td>{{ $value->orf_1_ab ?? '-' }}</td>
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
</div>



@endsection
