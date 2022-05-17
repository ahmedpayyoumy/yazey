<?php

namespace ESP\QRCode\Helpers;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use App\Helpers\UploadFileToS3;
use File;
use Storage;

class QRCodeHelper
{
    public static function generateCode($text="", $isS3Upload = true, $imagePath = null)
    {
        $writer = new PngWriter();
        // Create QR code
        $qrCode = QrCode::create($text)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        if ($imagePath) {
            // Create generic logo
            $logo = Logo::create(public_path($imagePath))
                ->setResizeToWidth(100);
            $result = $writer->write($qrCode, $logo);
        } else {
            $result = $writer->write($qrCode);
        }

        if (!is_dir(public_path('qr_code'))) {
            mkdir(public_path('qr_code'));
        }
        $fileName = 'qr_code/qr_code'.time().'.png';
        $uploadLink = public_path($fileName);
        $result->saveToFile($uploadLink);
        if ($isS3Upload) {
            $destinationFile = UploadFileToS3::putFile($uploadLink, 'qr_code');
            File::delete($uploadLink);
        } else {
            $destinationFile = $fileName;
        }
        return $destinationFile;
    }
}
