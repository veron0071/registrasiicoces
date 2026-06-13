<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation - ICoCES-2026</title>
</head>
<body style="margin:0; padding:0; background-color:#f0f4f1; font-family: Arial, Helvetica, sans-serif;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f4f1; padding:24px 0;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden; max-width:600px; width:100%;">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1f5d3a; padding:32px 32px 24px 32px; text-align:center;">
                            <p style="margin:0; color:#cfe8d8; font-size:12px; letter-spacing:2px; text-transform:uppercase;">
                                Registration Confirmed
                            </p>
                            <h1 style="margin:8px 0 4px 0; color:#ffffff; font-size:22px; line-height:1.4;">
                                International Conference on Community Engagement for Sustainability
                            </h1>
                            <p style="margin:0; color:#a8d5bb; font-size:16px; font-weight:bold; letter-spacing:1px;">
                                ICoCES-2026
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0 0 16px 0; color:#222222; font-size:15px; line-height:1.6;">
                                Dear <strong>{{ $participant->full_name }}</strong>,
                            </p>

                            <p style="margin:0 0 20px 0; color:#444444; font-size:15px; line-height:1.6;">
                                Thank you for registering for <strong>ICoCES-2026</strong>. We are pleased to confirm
                                that your registration has been successfully received. Below is a summary of your
                                registration details:
                            </p>

                            <!-- Detail Card -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f6faf7; border:1px solid #e1ece4; border-radius:6px; margin-bottom:24px;">
                                <tr>
                                    <td style="padding:20px 24px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding:6px 0; color:#777777; font-size:13px; width:40%; vertical-align:top;">Full Name</td>
                                                <td style="padding:6px 0; color:#222222; font-size:14px; font-weight:bold;">{{ $participant->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#777777; font-size:13px; vertical-align:top;">Institution</td>
                                                <td style="padding:6px 0; color:#222222; font-size:14px;">{{ $participant->institution }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#777777; font-size:13px; vertical-align:top;">Email</td>
                                                <td style="padding:6px 0; color:#222222; font-size:14px;">{{ $participant->email }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#777777; font-size:13px; vertical-align:top;">Category</td>
                                                <td style="padding:6px 0; color:#222222; font-size:14px;">
                                                    {{ $participant->category === 'presenter' ? 'Presenter' : 'Non-Presenter' }}
                                                </td>
                                            </tr>
                                            @if($participant->category === 'presenter' && $participant->paper_title)
                                            <tr>
                                                <td style="padding:6px 0; color:#777777; font-size:13px; vertical-align:top;">Paper Title</td>
                                                <td style="padding:6px 0; color:#222222; font-size:14px;">{{ $participant->paper_title }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td style="padding:6px 0; color:#777777; font-size:13px; vertical-align:top;">Attendance</td>
                                                <td style="padding:6px 0; color:#222222; font-size:14px;">
                                                    {{ $participant->attendance === 'onsite' ? 'On-site (Semarang, Indonesia)' : 'Online' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#777777; font-size:13px; vertical-align:top;">Registration Fee</td>
                                                <td style="padding:6px 0; color:#222222; font-size:14px;">
                                                    {{ $participant->fee_currency }} {{ number_format($participant->fee_amount, 0) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0; color:#777777; font-size:13px; vertical-align:top;">Payment Status</td>
                                                <td style="padding:6px 0;">
                                                    <span style="display:inline-block; background-color:#fff3cd; color:#856404; font-size:12px; font-weight:bold; padding:3px 10px; border-radius:12px;">
                                                        PENDING VERIFICATION
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 20px 0; color:#444444; font-size:15px; line-height:1.6;">
                                Our team will review your payment proof and confirm your registration status within
                                <strong>2&ndash;3 business days</strong>. You will receive a follow-up email once your
                                payment has been verified.
                            </p>

                            <!-- Event Info Box -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-left:4px solid #1f5d3a; background-color:#f6faf7; margin-bottom:24px;">
                                <tr>
                                    <td style="padding:16px 20px;">
                                        <p style="margin:0 0 8px 0; color:#1f5d3a; font-size:14px; font-weight:bold;">
                                            📅 Event Details
                                        </p>
                                        <p style="margin:0; color:#444444; font-size:14px; line-height:1.6;">
                                            <strong>Date:</strong> September 24, 2026<br>
                                            <strong>Format:</strong> On-site in Semarang, Central Java, Indonesia &amp; Online Everywhere<br>
                                            <strong>Organizer:</strong> Center of Research and Community Engagement (LPPM), Universitas Wahid Hasyim
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 20px 0; color:#444444; font-size:15px; line-height:1.6;">
                                We truly appreciate your participation in advancing meaningful dialogue on community
                                engagement and sustainability. Together, let us strengthen collaboration, share
                                innovative ideas, and contribute to the Sustainable Development Goals (SDGs).
                            </p>

                            <p style="margin:0; color:#444444; font-size:15px; line-height:1.6;">
                                If you have any questions regarding your registration, feel free to reply to this email.
                            </p>
                        </td>
                    </tr>

                    <!-- Closing -->
                    <tr>
                        <td style="padding:0 32px 32px 32px;">
                            <p style="margin:0; color:#222222; font-size:15px; line-height:1.6;">
                                Warm regards,<br>
                                <strong>ICoCES-2026 Organizing Committee</strong><br>
                                LPPM Universitas Wahid Hasyim
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f6faf7; padding:20px 32px; text-align:center; border-top:1px solid #e1ece4;">
                            <p style="margin:0; color:#999999; font-size:12px; line-height:1.6;">
                                ✨ Be part of the dialogue. Be part of the change. Be part of ICoCES-2026 ✨
                            </p>
                            <p style="margin:8px 0 0 0; color:#bbbbbb; font-size:11px;">
                                This is an automated message, please do not reply directly if not necessary.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>