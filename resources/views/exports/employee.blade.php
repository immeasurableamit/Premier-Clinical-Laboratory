<table>
    <thead>
    <tr>
        <th>Employee Name</th>
        <th>Email</th>
        <th> Phone</th>
        <th>Days</th>
        <th>Result</th>
        <th>Message</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)

        <tr>
            <td>{{  $item->name }}</td>
            <td> {{  $item->email }}</td>
            <td> {{  $item->phone }}</td>
            <td> {{  0 }}</td>
            <td>Error</td>
            <td>Email or phone already in use</td>
        </tr>
    @endforeach
    </tbody>
</table>
