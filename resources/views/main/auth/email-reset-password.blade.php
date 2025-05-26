<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <title>Reset Password</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        table,
        td {
            border-collapse: collapse;
        }

        img {
            border: 0;
            height: auto;
        }

        p {
            margin: 13px 0;
        }

        @media only screen and (max-width:480px) {
            @-ms-viewport {
                width: 320px;
            }

            @viewport {
                width: 320px;
            }
        }

        @media only screen and (min-width:480px) {
            .mj-column-per-100 {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style="background-color:#f9f9f9;">
    <div style="background-color:#f9f9f9;max-width:600px;margin:auto;">
        <table align="center" style="width:100%;background:#fff;border:1px solid #ddd;">
            <tr>
                <td style="text-align:center;padding:20px;border-bottom:5px solid;">
                    <h1 style="font-size:2rem;font-family:sans-serif;font-weight:bold;color:#000;">
                        WTC<span style="color:#d3e227;">2</span>JAPAN
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="padding:20px;text-align:center;">
                    <h2 style="font-family:'Helvetica Neue',Arial,sans-serif;color:#555;">Reset Your Password</h2>
                    <p style="font-size:16px;line-height:1.5;color:#555;">
                        We received a request to reset your password. Click the button below to reset it:
                    </p>
                    <p style="margin:30px 0;">
                        <a href="{{ route('resetPassword', ['token' => $token, 'email' => $email]) }}"
                            style="background:#2F67F6;color:#fff;padding:15px 25px;border-radius:3px;text-decoration:none;font-family:'Helvetica Neue',Arial,sans-serif;">
                            Reset Password
                        </a>
                    </p>

                    <p style="font-size:16px;line-height:1.5;color:#555;">
                        Or you can click the following link:
                        <br>
                        <a href="{{ route('resetPassword', ['token' => $token, 'email' => $email]) }}"
                            style="color:#2F67F6;">
                            {{ route('resetPassword', ['token' => $token, 'email' => $email]) }}
                        </a>
                    </p>

                    <p style="margin-top:40px;font-size:16px;color:#555;">
                        If you did not request a password reset, please ignore this email.
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding:20px;text-align:center;font-size:14px;color:#777;">
                    Need help? Contact us at <a href="mailto:worldtrainingcenterjapan@gmail.com"
                        style="color:#2F67F6;">worldtrainingcenterjapan@gmail.com</a>
                </td>
            </tr>
            <tr>
                <td style="padding:20px;text-align:center;font-size:12px;color:#575757;">
                    Jl. Cempaka No. 1 Paya, Kec. Karangasem, Kabupaten Karangasem, Bali 80811
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
