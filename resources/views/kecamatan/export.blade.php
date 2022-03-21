<table>
    <thead>
        <tr>
            <th>PROVINCE</th>
            <th>CITY</th>
            <th>KELURAHAN</th>
            <th>KECAMATAN</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row => $val)
            <tr>
                <td>{{ $val['provname'] }}</td>
                <td>{{ $val['cityname'] }}</td>
                <td>{{ $val['keluname'] }}</td>
                <td>{{ $val['kecaname'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
