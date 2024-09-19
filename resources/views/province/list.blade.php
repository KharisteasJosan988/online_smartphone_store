<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Data Provinsi</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
        </tr>
        @foreach ($response->rajaongkir->results as $province)
            <tr>
                <td>{{ $province->province_id }}</td>
                <td>{{ $province->province }}</td>
            </tr>
        @endforeach
        <select name="" id="">
            @foreach ($response->rajaongkir->results as $province)
                <option value="{{ $province->province_id }}">{{ $province->province }}</option>
            @endforeach
        </select>
    </table>
</body>

</html>
