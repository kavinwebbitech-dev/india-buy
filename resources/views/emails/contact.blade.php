<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f9; font-family: Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f9; padding:30px 0;">
        <tr>
            <td align="center">
                
                <!-- Main Card -->
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background:#0d6efd; padding:20px; text-align:center; color:#ffffff;">
                            <h2 style="margin:0; font-size:22px;">New Contact Form Submission</h2>
                            <p style="margin:5px 0 0; font-size:14px; opacity:0.9;">
                                You have received a new enquiry from your website
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:25px;">
                            
                            <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;">
                                
                                <tr style="background:#f8f9fa;">
                                    <td style="width:35%; font-weight:bold; color:#333;">First Name</td>
                                    <td style="color:#555;">{{ $contact->fname }}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; color:#333;">Last Name</td>
                                    <td style="color:#555;">{{ $contact->lname }}</td>
                                </tr>

                                <tr style="background:#f8f9fa;">
                                    <td style="font-weight:bold; color:#333;">Phone</td>
                                    <td style="color:#555;">{{ $contact->phone }}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; color:#333;">Email</td>
                                    <td style="color:#555;">
                                        <a href="mailto:{{ $contact->email }}" style="color:#0d6efd; text-decoration:none;">
                                            {{ $contact->email }}
                                        </a>
                                    </td>
                                </tr>

                                <tr style="background:#f8f9fa;">
                                    <td style="font-weight:bold; color:#333; vertical-align:top;">Message</td>
                                    <td style="color:#555; line-height:1.6;">
                                        {{ $contact->message ?? 'N/A' }}
                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f1f3f5; padding:15px; text-align:center; font-size:13px; color:#777;">
                            © {{ date('Y') }} {{ config('app.name') }} | Contact Notification
                        </td>
                    </tr>

                </table>
                <!-- End Card -->

            </td>
        </tr>
    </table>

</body>
</html>