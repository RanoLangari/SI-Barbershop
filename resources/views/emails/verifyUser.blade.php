<!DOCTYPE html>
<html>

<head>
    <title>Welcome Email</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="background-color: #f4f4f4; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <h1 style="color: #4f46e5; font-size: 24px;">Welcome, {{ $user['name'] }}! 👋</h1>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="color: #333; font-size: 16px; padding-bottom: 20px;">
                            Terima kasih telah mendaftar di Zeroseven Barbershop. Kami sangat senang Anda bergabung
                            dengan kami. Klik tombol di bawah ini untuk verifikasi email Anda.
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="{{ url('user/verify', $user->verifyUser->token) }}"
                                style="display: inline-block; background-color: #4f46e5; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 5px; font-size: 16px; font-weight: bold;">
                                Verifikasi Email Sekarang
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-top: 30px;">
                            <table width="100%" cellpadding="10">
                                <tr>
                                    <td align="center"
                                        style="background-color: #f9f9f9; padding: 10px; border-radius: 5px;">
                                        <strong>Booking Mudah</strong>
                                    </td>
                                    <td align="center"
                                        style="background-color: #f9f9f9; padding: 10px; border-radius: 5px;">
                                        <strong>Profesional Berpengalaman</strong>
                                    </td>
                                    <td align="center"
                                        style="background-color: #f9f9f9; padding: 10px; border-radius: 5px;">
                                        <strong>Support 24/7</strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-top: 20px; color: #777; font-size: 14px;">
                            Jika Anda tidak merasa mendaftar, abaikan email ini.
                        </td>
                    </tr>
                    <tr>
                        <td align="center"
                            style="padding-top: 10px; font-size: 14px; color: #4f46e5; font-weight: bold;">
                            Zeroseven Barbershop Team
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
