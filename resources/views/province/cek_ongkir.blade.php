{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Cek Harga Ongkir</h1>
    <form action="{{ route('cek-ongkir') }}" method="POST">
        @csrf
        <p>
            Provinsi Asal
            <select name="province_asal" id="province_asal">
                @foreach ($provinces as $province)
                    <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                @endforeach
            </select>
        </p>
        <p>
            Kota Asal
            <select name="id_kota_asal" id="city_asal">
                <option>Pilih Kota Asal</option>
            </select>
        </p>
        <p>
            Provinsi Tujuan
            <select name="province_tujuan" id="province_tujuan">
                @foreach ($provinces as $province)
                    <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                @endforeach
            </select>
        </p>
        <p>
            Kota Tujuan
            <select name="id_kota_tujuan" id="city_tujuan">
                <option>Pilih Kota Tujuan</option>
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
            <input type="number" min="1" name="berat" id="" required>
        </p>

        <button type="submit">Cek Ongkir</button>
    </form>


    <script>
        document.getElementById('province_asal').addEventListener('change', function() {
            var provinceId = this.value;
            fetch(`/ro/get-cities/${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    var citySelect = document.getElementById('city_asal');
                    citySelect.innerHTML = '';
                    data.forEach(function(city) {
                        citySelect.innerHTML +=
                            `<option value="${city.city_id}">${city.city_name}</option>`;
                    });
                });
        });

        document.getElementById('province_tujuan').addEventListener('change', function() {
            var provinceId = this.value;
            fetch(`/ro/get-cities/${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    var citySelect = document.getElementById('city_tujuan');
                    citySelect.innerHTML = '';
                    data.forEach(function(city) {
                        citySelect.innerHTML +=
                            `<option value="${city.city_id}">${city.city_name}</option>`;
                    });
                });
        });
    </script>

</body>

</html> --}}
