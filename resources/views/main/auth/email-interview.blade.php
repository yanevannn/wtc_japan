<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <title>Seleksi Notification</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        body {
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #555555;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #dddddd;
            padding: 20px;
        }

        h1 {
            color: #000;
            font-weight: bold;
        }

        .highlight {
            color: #d3e227;
        }

        .btn {
            display: inline-block;
            background-color: #2F67F6;
            color: #fff !important;
            padding: 15px 25px;
            border-radius: 3px;
            text-decoration: none;
            font-size: 15px;
        }

        .footer {
            font-size: 12px;
            color: #575757;
            text-align: center;
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div style="background-color:#f9f9f9; padding: 20px 0;">

        <div class="container" style="text-align:center;">
            <h1>WTC<span class="highlight">2</span>JAPAN</h1>

            <p>Halo <strong>{{ $namaSiswa }}</strong>,</p>

            @if (strtolower(trim($status)) === 'lolos')
                <h2>Selamat! Anda Lolos Seleksi</h2>
                <p>Anda telah berhasil lolos seleksi untuk wawancara di perusahaan <br> <strong>{{ $perusahaan }}</strong>.
                </p>
                <p>Silakan klik tombol di bawah untuk melihat detail selanjutnya:</p>
                <p>
                    <a href="{{ route('interview.index') }}" class="btn">Lihat Detail Seleksi</a>
                </p>
            @else
                <h2>Informasi Hasil Seleksi</h2>
                <p>Terima kasih atas partisipasi Anda dalam proses seleksi di perusahaan <br>
                    <strong>{{ $perusahaan }}</strong>.</p>
                <p>Mohon maaf, saat ini Anda <strong>TIDAK LOLOS</strong> seleksi tahap ini.</p>
                <p>Jangan berkecil hati, tetap semangat.</p>
                <p>silahkan melakukan pendaftaran kembali pada website untuk interview di perusahaan lainnya.</p>
            @endif

            <hr style="margin: 30px 0; border-color: #dddddd;">

            <p>Butuh bantuan? Hubungi kami di <a href="mailto:worldtrainingcenterjapan@gmail.com"
                    style="color:#2F67F6;">worldtrainingcenterjapan@gmail.com</a></p>

            <div class="footer">
                <p>Jl. Cempaka No. 1 Paya, Kec. Karangasem, Kabupaten Karangasem, Bali 80811</p>
            </div>
        </div>

    </div>
</body>

</html>
