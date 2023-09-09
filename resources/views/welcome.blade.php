<!doctype html>
<html lang="en">
<head>
    <script src="{{asset('js/main.jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="form-content">
        <form action="{{route('search')}}" id="data">
            <div class="input-row-1">
                <label for="searchinput">Name</label>
                <input type="text" id="searchinput" name="name" placeholder="Name" onkeyup="searchKeyup()">
            </div>
            <div class="input-row-2">
                <div class="row-item">
                    <label for="bathrooms">Bathrooms</label>
                    <select name="bathrooms" id="bathrooms" onchange="searchChange()">
                        <option value="">---</option>
                        @for($i=1; $i<=5; $i++)
                            <option value="{{$i}}">
                                {{$i}}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="row-item">
                    <label for="bedrooms">Bedrooms</label>
                    <select name="bedrooms" id="bedrooms" onchange="searchChange()">
                        <option value="">---</option>
                        @for($i=1; $i<=5; $i++)
                            <option value="{{$i}}">
                                {{$i}}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="input-row-2">
                <div class="row-item">
                    <label for="storeys">Storeys</label>
                    <select name="storeys" id="storeys" onchange="searchChange()">
                        <option value="">---</option>
                        @for($i=1; $i<=5; $i++)
                            <option value="{{$i}}">
                                {{$i}}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="row-item">
                    <label for="garages">Garages</label>
                    <select name="garages" id="garages" onchange="searchChange()">
                        <option value="">---</option>
                        @for($i=1; $i<=5; $i++)
                            <option value="{{$i}}">
                                {{$i}}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="input-row-2">
                <div class="row-item">
                    <label for="price_from">Price from</label>
                    <input type="number" min="1" name="price_from" id="price_from" placeholder="Price from" onkeyup="searchKeyup()">
                </div>
                <div class="row-item">
                    <label for="price_to">Price to</label>
                    <input type="number" min="1" name="price_to" id="price_to" placeholder="Price to" onkeyup="searchKeyup()">
                </div>
            </div>
        </form>
    </div>

    <div class="data-content">
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
    </div>
</div>
<script>

    function searchKeyup() {
        let form = document.querySelector('#data');
        let data = new FormData(form);
        let serializedData = {};

        data.forEach(function (value, key) {
            serializedData[key] = value;
        });
        searchBox(serializedData)
    }

    function searchChange() {
        let form = document.querySelector('#data');
        let data = new FormData(form);
        let serializedData = {};

        data.forEach(function (value, key) {
            serializedData[key] = value;
        });

        searchBox(serializedData)
    }

    function searchBox(form) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $('#data').attr('action'),
            type: 'POST',
            data: form,
            success: function (result) {
                if (result.response == true) {
                    $('.data-content').html(result.view)
                }

            }
        });

    }


</script>
</body>
</html>
