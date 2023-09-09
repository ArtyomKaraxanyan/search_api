<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Bedrooms</th>
        <th>Bathrooms</th>
        <th>Storeys</th>
        <th>Garages</th>
    </tr>
    @forelse($dates as $data)
        <tr>
            <td>{{$data->name}}</td>
            <td>{{$data->price}}</td>
            <td>{{$data->bedrooms}}</td>
            <td>{{$data->bathrooms}}</td>
            <td>{{$data->storeys}}</td>
            <td>{{$data->garages}}</td>
        </tr>
    @empty

    @endforelse
</table>
