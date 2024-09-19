<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Detail Ongkos Kirim</h1>
    <p>
        Kota Asal = {{ $data->origin_details->city_name . ', ' . $data->origin_details->province }}
    </p>
    <p>
        Kota Tujuan = {{ $data->destination_details->city_name . ', ' . $data->destination_details->province }}
    </p>
    <p>
        Kurir = {{ $data->results[0]->name }} <br>
        @foreach ($data->results[0]->costs as $cost)
            {{ $cost->service }} Rp {{ $cost->cost[0]->value }}, {{ $cost->cost[0]->etd }} <br>
        @endforeach
    </p>

</body>

</html>
