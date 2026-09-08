<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>New Contact Enquiry</title>
</head>

<body style="margin:0; padding:0; background:#f4f6f8; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f4f6f8; padding:40px 15px;">
    <tr>
        <td align="center">

            <table width="650" cellpadding="0" cellspacing="0" border="0"
                style="max-width:650px; width:100%; background:#ffffff; border:1px solid #e5e7eb;">

                <!-- Header -->
                <tr>
                    <td style="background:#1f2937; padding:25px 30px;">

                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                                    <h2 style="margin:0; color:#ffffff; font-size:22px; font-weight:600;">
                                        New Contact Enquiry
                                    </h2>

                                    <p style="margin:7px 0 0; color:#d1d5db; font-size:13px;">
                                        A new enquiry has been submitted through your website.
                                    </p>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                <!-- Content -->
                <tr>
                    <td style="padding:30px;">

                        <p style="margin:0 0 25px; color:#374151; font-size:15px; line-height:1.6;">
                            Hello Team,
                        </p>

                        <p style="margin:0 0 25px; color:#4b5563; font-size:14px; line-height:1.7;">
                            You have received a new contact enquiry. Please find the submitted
                            information below.
                        </p>

                        <!-- Contact Details -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                            style="border:1px solid #e5e7eb;">

                            <!-- First Name -->
                            <tr>
                                <td width="35%"
                                    style="padding:14px 16px; background:#f9fafb; border-bottom:1px solid #e5e7eb; color:#374151; font-size:14px; font-weight:600;">
                                    First Name
                                </td>

                                <td
                                    style="padding:14px 16px; border-bottom:1px solid #e5e7eb; color:#4b5563; font-size:14px;">
                                    {{ $data['firstname'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <!-- Last Name -->
                            <tr>
                                <td
                                    style="padding:14px 16px; background:#f9fafb; border-bottom:1px solid #e5e7eb; color:#374151; font-size:14px; font-weight:600;">
                                    Last Name
                                </td>

                                <td
                                    style="padding:14px 16px; border-bottom:1px solid #e5e7eb; color:#4b5563; font-size:14px;">
                                    {{ $data['lastname'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <!-- Email -->
                            <tr>
                                <td
                                    style="padding:14px 16px; background:#f9fafb; border-bottom:1px solid #e5e7eb; color:#374151; font-size:14px; font-weight:600;">
                                    Email Address
                                </td>

                                <td
                                    style="padding:14px 16px; border-bottom:1px solid #e5e7eb; color:#4b5563; font-size:14px;">
                                    <a href="mailto:{{ $data['email'] ?? '' }}"
                                        style="color:#2563eb; text-decoration:none;">
                                        {{ $data['email'] ?? 'N/A' }}
                                    </a>
                                </td>
                            </tr>

                            <!-- Phone -->
                            <tr>
                                <td
                                    style="padding:14px 16px; background:#f9fafb; border-bottom:1px solid #e5e7eb; color:#374151; font-size:14px; font-weight:600;">
                                    Phone Number
                                </td>

                                <td
                                    style="padding:14px 16px; border-bottom:1px solid #e5e7eb; color:#4b5563; font-size:14px;">
                                    {{$data['country_code']}} {{ $data['phone'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <!-- Service -->
                            <tr>
                                <td
                                    style="padding:14px 16px; background:#f9fafb; border-bottom:1px solid #e5e7eb; color:#374151; font-size:14px; font-weight:600;">
                                    Selected Service
                                </td>

                                <td
                                    style="padding:14px 16px; border-bottom:1px solid #e5e7eb; color:#4b5563; font-size:14px;">
                                    {{ $data['select_services'] ?? 'N/A' }}
                                </td>
                            </tr>

                            <!-- Enquiry -->
                            <tr>
                                <td
                                    style="padding:14px 16px; background:#f9fafb; color:#374151; font-size:14px; font-weight:600; vertical-align:top;">
                                    Enquiry
                                </td>

                                <td
                                    style="padding:14px 16px; color:#4b5563; font-size:14px; line-height:1.7;">
                                    {{ $data['enquiry'] ?? 'N/A' }}
                                </td>
                            </tr>

                        </table>

                        <!-- Action -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                            style="margin-top:25px;">
                            <tr>
                                <td style="background:#f9fafb; padding:16px 18px; border-left:4px solid #2563eb;">

                                    <p style="margin:0; color:#374151; font-size:13px; line-height:1.6;">
                                        <strong>Action Required:</strong>
                                        Please review this enquiry and respond to the customer
                                        at your earliest convenience.
                                    </p>

                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background:#f9fafb; border-top:1px solid #e5e7eb; padding:20px 30px; text-align:center;">

                        <p style="margin:0; color:#6b7280; font-size:12px; line-height:1.6;">
                            This is an automated notification generated from your website contact form.
                        </p>

                        <p style="margin:6px 0 0; color:#9ca3af; font-size:11px;">
                            © {{ date('Y') }} Your Company. All rights reserved.
                        </p>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
