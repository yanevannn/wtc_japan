<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>HASIL SELEKSI</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: black;
            padding: 40px;
            max-width: 700px;
            margin: auto;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        h4 {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 10px;
        }

        .header p {
            margin: 2px 0;
            font-size: 12px;
        }

        .info-table {
            width: 100%;
            margin-top: 24px;
            text-align: left;
        }

        .info-table td {
            padding: 4px 8px;
            vertical-align: top;
        }

        .info-table td.label {
            width: 120px;
            /* atur sesuai kebutuhan */
            padding-right: 5px;
            white-space: nowrap;
        }

        .info-table td.value {
            padding-left: 5px;
        }


        .nilai-table {
            width: 100%;
            margin-top: 24px;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        }

        .nilai-table th,
        .nilai-table td {
            border: 1px solid black;
            padding: 6px;
        }

        .nilai-table th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: right;
            margin-top: 60px;
        }

        .footer p {
            margin: 4px 0;
        }

        .footer strong {
            display: inline-block;
            margin-top: 60px;
        }

        hr {
            margin: 12px 0;
            border: none;
            border-top: 1px solid black;
        }
    </style>
</head>

<body>

    <!-- Header WTC JAPAN -->
    <div class="header">
        <h1>WTC <span style="color:#d3e227">2</span> JAPAN</h1>
        <p>Lembaga Pelatihan Kerja Swasta World Training Center Pemagangan ke Jepang</p>
        <p>Jl. Serma Natih, Padang Kerta, Kec. Karangasem, Kabupaten Karangasem, Bali 80811</p>
        <p>Telp. +6281337089675 | Email: worldtrainingcenterjapan@gmail.com</p>
    </div>

    <hr />

    <h4>NILAI HASIL SELEKSI</h4>

    <!-- Info Table -->
    <table class="info-table">
        <tbody>
            <tr>
                <td class="label"><strong>Nama</strong></td>
                <td class="value">: {{ $data->siswa->user->fname . ' ' . $data->siswa->user->lname }}</td>
            </tr>
            <tr>
                <td class="label"><strong>NIS</strong></td>
                <td class="value">: {{ $data->siswa->nis }}</td>
            </tr>
            <tr>
                <td class="label"><strong>Angkatan </strong></td>
                <td class="value">: Angkatan {{ $data->siswa->angkatan->nomor_angkatan }}</td>
            </tr>
            <tr>
                <td class="label"><strong>Tahun</strong></td>
                <td class="value">: {{ $data->siswa->angkatan->tahun }}</td>
            </tr>
        </tbody>
    </table>


    <!-- Nilai Table -->
    <table class="nilai-table">
        <thead>
            <tr>
                <th style="width: 10px">NO</th>
                <th>NILAI</th>
                <th>NILAI AKHIR</th>
            </tr>
        </thead>
        <tbody>
            @php
                function nilaiHuruf($nilai)
                {
                    if ($nilai >= 90) {
                        return 'A';
                    }
                    if ($nilai >= 80) {
                        return 'B';
                    }
                    if ($nilai >= 70) {
                        return 'C';
                    }
                    if ($nilai >= 60) {
                        return 'D';
                    }
                    return 'E';
                }
            @endphp
            <tr>
                <td>1</td>
                <td>{{ $data->hiragana }}</td>
                <td>{{ nilaiHuruf($data->hiragana) }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{ $data->katakana }}</td>
                <td>{{ nilaiHuruf($data->katakana) }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>{{ $data->kanji }}</td>
                <td>{{ nilaiHuruf($data->kanji) }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>{{ $data->bunpou }}</td>
                <td>{{ nilaiHuruf($data->bunpou) }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>{{ $data->choukai }}</td>
                <td>{{ nilaiHuruf($data->choukai) }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td>{{ $data->kaiwa }}</td>
                <td>{{ nilaiHuruf($data->kaiwa) }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td>{{ $data->dokkai }}</td>
                <td>{{ nilaiHuruf($data->dokkai) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Karangasem, {{ now()->locale('id')->format('d F Y') }}</p>
        <p>Ketua WTCJAPAN</p>
        <strong>WTC2JAPAN</strong>
    </div>

</body>

</html>
