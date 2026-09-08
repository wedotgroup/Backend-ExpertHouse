<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Submission</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, Helvetica, sans-serif;">

    <div
        style="max-width:600px; margin:40px auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.08);">

        <!-- Header -->
        <div style="background:#2563eb; padding:25px; text-align:center;">
            <h2 style="margin:0; color:#ffffff; font-size:24px;">
                New Contact Submission
            </h2>
        </div>

        <!-- Content -->
        <div style="padding:30px;">

            <p style="margin:0 0 20px; color:#333333; font-size:16px;">
                You have received a new contact form submission.
            </p>

            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">

                <tr>
                    <td style="padding:14px 12px; border-bottom:1px solid #e5e7eb; font-weight:bold; color:#555;">
                        Name
                    </td>
                    <td style="padding:14px 12px; border-bottom:1px solid #e5e7eb; color:#333;">
                        {{ $data['name'] }}
                    </td>
                </tr>



                <tr>
                    <td style="padding:14px 12px; border-bottom:1px solid #e5e7eb; font-weight:bold; color:#555;">
                        Email
                    </td>
                    <td style="padding:14px 12px; border-bottom:1px solid #e5e7eb; color:#333;">
                        <a href="mailto:{{ $data['email'] }}" style="color:#2563eb; text-decoration:none;">
                            {{ $data['email'] }}
                        </a>
                    </td>
                </tr>

                <tr>
                    <td style="padding:14px 12px; font-weight:bold; color:#555;">
                        Phone
                    </td>
                    <td style="padding:14px 12px; color:#333;">
                        <a href="tel:{{ $data['phone'] }}" style="color:#2563eb; text-decoration:none;">
                            {{ $data['phone'] }}
                        </a>
                    </td>
                </tr>

            </table>

        </div>

        <!-- Footer -->
        <div style="background:#f8fafc; padding:18px 30px; text-align:center;">
            <p style="margin:0; color:#888888; font-size:13px;">
                This email was sent from your website contact form.
            </p>
        </div>

    </div>

</body>

</html>
