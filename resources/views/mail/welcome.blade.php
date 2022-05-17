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
        <td class="mail-content" style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 16.5px; border: none;">
            <table align="left" bgcolor="#fff" style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 32px 48px; border: none;">
                <tr class="" style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                    <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 24px; margin: auto; padding: 0; border: none;">
                        Hello {{$name ?? ''}},
                    </td>
                </tr>
                <tr style="font-family: 'Inter', sans-serif; font-size: 16px; margin: auto; padding: 0; border: none;">
                    <td style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 24px; margin: auto; padding: 0; border: none;">
                        Welcome {{$name ?? ''}} using Yazey.com
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>