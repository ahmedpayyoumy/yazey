<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0;">
<head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
@media (max-width: 376px) {
  .mail-content table {
    padding-left: 10px !important; padding-right: 10px !important;
  }
  .mail-footer {
    padding-left: 16.5px !important; padding-right: 16.5px !important;
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
            <img src="https://aiosale.com/images/logo.png" style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0;">
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
                        <strong style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0;">We got a request change password of your account at {{$timeCreated ?? ''}} - {{$dateCreated ?? ''}}.</strong>
                    </td>
                </tr>
                <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                    <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 24px; margin: auto; padding: 0 0 24px; border: none;">
                        But we can't find your email in our system. Please click <a href="{{route('authenticate.register')}}" target="_blank" class="mail-link" style="font-family: 'Inter', sans-serif; font-size: 16px; text-decoration: none; color: #4F46E5; font-weight: bold; margin: auto; padding: 0;">đây</a> to register.
                    </td>
                </tr>
                <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                    <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 24px; margin: auto; padding: 0 0 24px; border: none;">
                        Please contact <a href="mailto:contact@aiosale.com" style="font-family: 'Inter', sans-serif; font-size: 16px; text-decoration: none; color: #000; font-weight: bold; margin: auto; padding: 0;">contact@aiosale.com</a> for support.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
        <td class="mail-footer" style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 72px 64px 40px; border: none;">
            <table align="left" style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                    <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 22px; margin: auto; padding: 0 0 16px; border: none;">
                        <img src="https://aiosale.com/images/logo.png" style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0;">
                    </td>

                </tr>
                <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                    <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 22px; margin: auto; padding: 0 0 16px; border: none;">
                        &copy;Aiosale 2020 <br style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0;">
                        56 Nguyen Dinh Chieu, <br style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0;">
                        Dakao, District 1, HCMC, VN
                    </td>
                </tr>
                <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                    <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 22px; margin: auto; padding: 0 0 16px; border: none;">
                        <a href="{{env('APP_URL')}}" class="mail-link" style="font-family: 'Inter', sans-serif; font-size: 16px; text-decoration: none; color: #4F46E4; font-weight: bold; margin: auto 8px auto auto; padding: 0;">Facebook</a>
                        <a href="{{env('APP_URL')}}" class="mail-link" style="font-family: 'Inter', sans-serif; font-size: 16px; text-decoration: none; color: #4F46E5; font-weight: bold; margin: auto; padding: 0;">LinkedIn</a>
                    </td>
                </tr>
            </table>
        </td>

    </tr>

</table>
</body>
</html>
