<?php
namespace App\Helper;
use GuzzleHttp\Client;
class Api
{
    const API = "http://mkt68.com:2323/";
    const FCODE =  2 ;
    public function connectApi($uri, $data, $method, $isMultipart = false, $isJson = true, $token = '', $customHeader = [] , $fcode = ''){
        $client = new Client(['base_uri' => self::API, 'verify' => false]);
        if ($method == 'POST' || $method == 'PUT') {
            if($isMultipart){
                $arrHeader = array('Authorization' => 'aff '. (session('user_data')&&!$token ? session('user_data')['token'] : $token), 'fcode' => ( session('f_code') ? session('f_code') : ( $fcode !== '' ? $fcode : self::FCODE ) ) );
                if(!empty($customHeader)){
                    $arrHeader = array_merge($arrHeader, $customHeader);
                }
                $res = $client->request($method, $uri, [
                    'headers' => $arrHeader,
                    'multipart' => $data
                ]);
            }else{
                $arrHeader = array('Content-Type' => 'application/json', 'Authorization' => 'aff '. (session('user_data')&&!$token ? session('user_data')['token'] : $token), 'fcode' => ( session('f_code') ? session('f_code') : ( $fcode !== '' ? $fcode : self::FCODE )  ) );
                if(!empty($customHeader)){
                    $arrHeader = array_merge($arrHeader, $customHeader);
                }
                $res = $client->request($method, $uri, [
                    'headers' => $arrHeader,
                    'body' => json_encode($data)
                ]);
            }
        } else {
            $arrHeader = array('Content-Type' => 'application/json', 'Authorization' => 'aff '. (session('user_data')&&!$token ? session('user_data')['token'] : $token), 'fcode' => ( session('f_code') ? session('f_code') : ( $fcode !== '' ? $fcode : self::FCODE )  ));
            if(!empty($customHeader)){
                $arrHeader = array_merge($arrHeader, $customHeader);
            }
            $res = $client->request($method, $uri, [
                'headers' => $arrHeader
            ]);
        }
        if($isJson == true){
            return json_decode($res->getBody()->getContents(), true);
        }else{
            return $res->getBody()->getContents();
        }
    }

    // Check user
    public function getMyProfile($token = '' , $fcode = '' ) {
        $uri = "users?mod=my_profile";
        return $this->connectApi($uri, [], 'GET', $isMultipart = false, $isJson = true, $token, $customHeader = [] , $fcode );
    }

    public function listCampaignsForHtmlBuilder($arrParams){
        $uri = "campaigns?mod=get_list_campaign_html_builder";
        foreach($arrParams as $key => $params){
            $uri .= "&$key=$params";
        }
        return $this->connectApi($uri, [], 'GET');
    }

    public function listProductForHtmlBuilder($arrParams){
        $uri = "campaign_product?mod=get_list_campaign_product_html_builder";
        foreach($arrParams as $key => $params){
            $uri .= "&$key=$params";
        }
        return $this->connectApi($uri, [], 'GET');
    }
    public function getProductDetail($id){
        $uri = 'campaign_product?mod=get_detail_campaign_product&product_id='.$id;
        return $this->connectApi($uri, [], 'GET');
    }

    public function getCampaignDetail($id){
        $uri = 'campaigns?mod=get_detail_campaign&campaign_id='.$id;
        return $this->connectApi($uri, [], 'GET');
    }

    public function listProductByIds($arrParams){
        $uri = "campaign_product?mod=get_list_product_by_ids";
        foreach($arrParams as $key => $param){
            $uri .= "&$key=$param";
        }
        return $this->connectApi($uri, [], 'GET');
    }

    public function getListPaymentMethod() {
        $uri = 'payment?mod=list_payment_method';
        return $this->connectApi($uri, [], 'GET');
    }


}
