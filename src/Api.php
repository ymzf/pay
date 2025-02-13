<?php

namespace Ymzf\Pay;

class Api
{
    private $apiBaseUrl;
    private $app_id;
    private $apiKey;

    /**
     * 构造函数，初始化必要参数
     * @param string $app_id 应用ID
     * @param string $apiKey API密钥
     */
    public function __construct($app_id, $apiKey = "")
    {
        // 固定的API基础URL
        $this->apiBaseUrl = 'https://frp.980.lol:8443/api';
        // 应用ID
        $this->app_id = $app_id;
        $this->apiKey = $apiKey;
    }

    /**
     * 下单接口
     *
     * @param array $orderInfo 订单信息
     * @return array 响应数据
     */
    public function createOrder(array $orderInfo)
    {
        $orderInfo['app_id'] = $this->app_id;
        $signStr = $this->sign($orderInfo);
        $orderInfo['sign'] = $signStr;
        $result =  $this->http_curl_post('/pay/submit', $orderInfo);
        return json_decode($result, true);
    }

    /**
     * 查询订单接口
     *
     * @param string $system_order_no 系统订单号
     * @return array 响应数据
     */
    public function queryOrder($system_order_no)
    {
        $result = $this->http_curl_post("/pay/getOrderDetail/",[
            'app_id' => $this->app_id,
            'secret_key' => $this->apiKey,
            'system_order_no' => $system_order_no,
        ]);
        return json_decode($result, true);
    }

    /**
     * POST请求
     * @param $url
     * @param array $post_data
     * @param array $header
     * @return bool|string
     */
    function http_curl_post($url, $post_data,$header = array())
    {
        $ch = curl_init();
        if ($header == array()) {
            $header = array(
                'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36',
                'content-type: application/x-www-form-urlencoded; charset=UTF-8',
            );
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $this->apiBaseUrl . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // 我们在POST数据哦！
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    /**
     * 签名
     */
    public function sign(array $data)
    {
        ksort($data);
        $sign_str = '';
        foreach ($data as $key => $value) {
            if ($key == 'sign' || $key == 'sign_type' || $value == '') {
                continue;
            }
            $sign_str .= $key . '=' . $value . '&';
        }
        $sign_str .= "key=" . $this->apiKey;
        $sign_str = urlencode($sign_str);
        return md5($sign_str);
    }

    /**
     * 验证签名
     */
    public function verifySign(array $data)
    {
        $sign = $data['sign'];
        $new_sign = $this->sign($data);
        return $sign == $new_sign;
    }
}