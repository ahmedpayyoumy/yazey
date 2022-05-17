<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0;">

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

        @media (max-width: 376px) {
            .mail-content table {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }

            .mail-footer {
                padding-left: 16.5px !important;
                padding-right: 16.5px !important;
            }

            .btn-confirm {
                padding: 12px !important;
            }
        }
    </style>
</head>

<body style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0;">
    <table align="center" cellpadding="0" cellspacing="0" bgcolor="#F1F5F9" class="mail-layout" style="font-family: 'Inter', sans-serif; font-size: 16px; max-width: 658px; margin: auto; padding: 0; border: none;">
        <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
            <td class="mail-header" style="font-family: 'Inter', sans-serif; font-size: 16px; max-width: 658px; height: 62px; margin: auto; padding: 35px 65px 29px; border: none;">
                <div style="font-family: 'Inter', sans-serif; font-size: 20px; font-weight: bold; margin: auto; padding: 0;">Yazey.com</div>
            </td>
        </tr>
        <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
            <td class="mail-content" style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0 16.5px; border: none;">
                <table align="left" bgcolor="#fff" style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 32px 48px; border: none;">
                    <tr class="" style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                        <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 24px; margin: auto; padding: 0 0 24px; border: none;">
                            Hello {{$email ?? ''}},
                        </td>
                    </tr>
                    <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                        <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 24px; margin: auto; padding: 0 0 24px; border: none;">
                            <strong style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0;">We received your request to change your password at {{$timeCreated ?? ''}} day {{$dateCreated ?? ''}}.
                                Click the button below to change your password.</strong>
                        </td>
                    </tr>
                    <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                        <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 24px; margin: auto; padding: 0 0 24px; border: none;">
                            <a href="{{$url ?? '#'}}" target="_blank" class="btn btn-confirm" style="font-family: 'Inter', sans-serif; font-size: 16px; background-color: #6366F1; border-radius: 8px; color: #fff; text-decoration: none; font-weight: bold; margin: auto; padding: 12px 52px;">
                                Change the password</a>
                        </td>
                    </tr>
                    <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                        <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 24px; margin: auto; padding: 0 0 24px; border: none;">
                            This link will be in effect for the next 15 minutes. If you did not submit this request, please ignore this email.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</body>

</html>