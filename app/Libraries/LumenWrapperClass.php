<?php

namespace App\Libraries;

class LumenWrapperClass
{
    private $api_endpoints, $api_url, $api_key;

    public function __construct()
    {
        $this->api_url = env('LUMEN_BLOG_URL');

        $this->api_key = env('LUMEN_BLOG_API_KEY');

        $this->api_endpoints = [
            'blog' => 'blogs'
        ];
    }

    public function curlRequest(string $slug, string $params, string $method, array $post_data = []): object
    {
        $ch = curl_init();

        $headers = array(
            'api-key:' . $this->api_key
        );

        if ($method == 'PUT') {

            array_push($headers, 'Content-Type:application/x-www-form-urlencoded');

            $post_data = http_build_query($post_data);
        }

        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->api_url . $this->api_endpoints[$slug] . $params,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {

            $error_msg = curl_error($ch);

            throw new \Exception($error_msg);
        }

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $response = json_decode($response);

        if (!in_array($httpcode, $this->successStatusCodes())) {

            throw new \Exception($response->message);;
        }

        return $response;
    }

    private function successStatusCodes()
    {
        return [
            200,
            201
        ];
    }

}
