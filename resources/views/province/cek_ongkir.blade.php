<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Cek Harga Ongkir</h1>
    <form action="" method="POST">
        @csrf
        <p>
            Kota Asal
            <select name="id_kota_asal" id="">
                @foreach ($cities as $city)
                    <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                @endforeach
            </select>
        </p>
        <p>
            Kota Tujuan
            <select name="id_kota_tujuan" id="">
                @foreach ($cities as $city)
                    <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                @endforeach
            </select>
        </p>
        <p>
            Kurir
            <select name="kurir" id="">
                <option value="jne">JNE</option>
                <option value="pos">POS</option>
                <option value="tiki">TIKI</option>
            </select>
        </p>
        <p>
            Berat Barang (gram) <br>
            <input type="number" min="1" name="berat" id="">
        </p>
        <button type="submit">Cek Ongkir</button>
    </form>

</body>

</html>
