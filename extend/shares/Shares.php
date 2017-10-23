<?php
namespace shares;
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2017/10/5
 * Time: 20:05
 */
class Shares
{
    public function getShares()
    {
        $url = "http://hq.sinajs.cn/list=hk00700";
        $res = $this->PhpCURL($url);
        $res = preg_match('/[0-9]{3}\.[0-9]{3}/',$res, $result);
        if($res){
            return $result[0];
        }else{
            return 0;
        }

    }

    public function PhpCURL($url)
    {
        $res = curl_init();

        curl_setopt($res, CURLOPT_URL, $url);
        curl_setopt($res, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($res, CURLOPT_HEADER, 0);

        $output = curl_exec($res);
        curl_close($res);
        return $output;

    }
}