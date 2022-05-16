<?php

namespace App\Libraries;

class LumenWrapperClass
{
    public function __construct()
    {
        $this->apiURL = env('LUMEN_BLOG_URL');
    }

    public function getDataRequest($endpoint, $params = '')
    {
        try {

            $header = $this->getHeaders();

            $response = $this->getRequest($this->apiURL . $endpoint . $params, $header);

            return json_decode($response);

        } catch (\Exception $e) {
            //handle exception

            throw new \Exception($e->getMessage());
        }
    }

    public function postDataRequest($slug, $params, $post_data)
    {
        try {

            $header = $this->getHeaders();

            $response = $this->postRequest($this->apiURL . $this->api_end_points[$slug] . $params, $header, $post_data);

            return json_decode($response);

        } catch (\Exception $e) {
            //handle exception

            throw new \Exception($e->getMessage());
        }
    }

    public function getHeaders()
    {
        return array(
            'Accept: application/json'
        );
    }

    public function getRequest($apiURL, $headers)
    {
        try {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiURL);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_FAILONERROR, true);

            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {

                $error_msg = curl_error($ch);

                throw new \Exception($error_msg);
            }

            curl_close($ch);

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());
        }

        return $response;
    }

    public function postRequest($apiURL, $headers, $post_data)
    {
        try {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiURL);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {

                $error_msg = curl_error($ch);

                throw new \Exception($error_msg);
            }

            curl_close($ch);

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());
        }

        return $response;
    }


}
