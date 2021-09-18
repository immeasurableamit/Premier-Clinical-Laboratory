<table>
    <thead>
    <tr>
        <th>Package ID</th>
        <th>Employee ID</th>
        <th>Status</th>
        <th>Genes</th>
        <th>S Gene</th>
        <th>N Gene</th>
        <th>ORF1ab</th>
        <th>Date</th>
        <th>Time</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Package as $item)
        <tr>
            <td>{{ $item->package_number }}</td>
            <td>{{ $item->employee_id }}</td>
            <td>{{ $item->Report() }}</td>
            <td> - </td>
            <td> - </td>
            <td> - </td>
            <td>- </td>
            <td>{{ date('d/m/Y',strtotime($item->created_at))  }}</td>
            <td>{{   date('h:i A',strtotime($item->created_at))  }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
