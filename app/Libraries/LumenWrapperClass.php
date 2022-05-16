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

    public function postDataRequest($endpoint, $params, $post_data)
    {
        try {

            $header = $this->getHeaders();

            $response = $this->postRequest($this->apiURL . $endpoint . $params, $header, $post_data);

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

    private function curlRequest($apiURL, $headers, $method, $post_data = [])
    {
        try {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiURL);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

            if ($post_data) {

                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
            }

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
