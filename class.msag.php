<?php

//!--------------------------------------------------------
// @class        ms.ag order infromer API library
// @site         https://ms.ag
// @company      https://5rm.ru
// @author       Eugene Kartysh
// @licence      
// @version      27102018
//!--------------------------------------------------------



class msag
{


    private static $token = '{TOKEN FROM HTTPS://MS.AG/MANAGE}';
    private static $secret = '{SECRET FROM HTTPS://MS.AG/MANAGE}';



    /**
     * Creating new order
     * @access public
     * @param string $order_status order_status [1-6] [requried]
     * @param string $order order_title [not requried]
     * @return array:
     * [order_id] - Global order id
     * [status] - status of query, example [ok]
     */
    public static function createorder($order_status, $order = false)
    {
        $params = array(
            'method' => 'createorder',
            'token' => self::$token,
            'secret' => self::$secret,
            'order' => $order,
            'order_status' => $order_status,
        );

        $response = self::api_curl($params);
        $response = json_decode($response, true);
        return $response;
    }


    /**
     * Update order
     * @access public
     * @param string $order id or personal order title
     * @param string $order_status order_status [1-6] [requried]
     * @return array:
     * [status] - status of query, example [ok]
     */
    public static function updateorder($order, $order_status)
    {
        $params = array(
            'method' => 'updateorder',
            'token' => self::$token,
            'secret' => self::$secret,
            'order' => $order,
            'order_status' => $order_status,
        );
        $response = self::api_curl($params);
        $response = json_decode($response, true);
        return $response;
    }


    /**
     * Delete order
     * @access public
     * @param string $order order id or personal order title
     * @return array:
     * [status] - status of query, example [ok]
     */
    public static function deleteorder($order)
    {
        $params = array(
            'method' => 'deleteorder',
            'token' => self::$token,
            'secret' => self::$secret,
            'order' => $order,
        );
        $response = self::api_curl($params);
        $response = json_decode($response, true);
        return $response;
    }


    /**
     * get order details
     * @access public
     * @param string $order order id or personal order title
     * @return array:
     * [order_id] - order global id
     * [order_title] - order title if it created
     * [order_status] - order current status
     * [created_at] - order created date
     * [deleted_at] - order deleted date if order was deleted
     * [status] - status of query, example [ok]
     */
    public static function getorder($order)
    {
        $params = array(
            'method' => 'getorder',
            'token' => self::$token,
            'secret' => self::$secret,
            'order' => $order,
        );

        $response = self::api_curl($params);
        $response = json_decode($response, true);
        return $response;
    }








//  method for send curl
    private static function api_curl($params)
    {
        $url = 'https://ms.ag/api/';

        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params)
        ));
        $response = curl_exec($myCurl);
        curl_close($myCurl);
        return $response;
    }


    public function api_fileGetContents($link)
    {
        return file_get_contents($link);
    }

}