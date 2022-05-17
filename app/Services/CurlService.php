<?php
namespace App\Services;

/**
 *
 */
class CurlService
{
    private $headers;
    public function __construct()
    {
        $this->headers = [
            'Content-Type: application/json',
        ];
    }
    public function sendGetRequestApi($url, $additionalHeaders = [])
    {
        if (count($additionalHeaders)) {
            $this->headers = array_merge($this->headers, $additionalHeaders);
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'Yaezy Get request',
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $this->headers,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function sendPostRequestApi($url, $jsonData, $additionalHeaders = [])
    {
        if (count($additionalHeaders)) {
            $this->headers = array_merge($this->headers, $additionalHeaders);
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERAGENT => 'Yaezy Post request',
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => $this->headers
        ));
        $resp = curl_exec($curl);
        $resp = json_decode($resp, true);
        curl_close($curl);
        return $resp ?? null;
    }
}
