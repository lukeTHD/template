<?php

namespace App\Http\Controllers;

use App\Helper\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class CampaignController extends Controller
{
    //
    private $api;
    private $listCurrency;

    public function __construct(Api $api)
    {
        $this->api = $api;
        $this->listCurrency = ['VND', 'USD'];
    }

    public function listCampaginsApi(Request $request)
    {
        $queryParam = $request->query();
        $currPage = isset($queryParam['page']) ? intval($queryParam['page']) : 1;
        $limit = isset($queryParam['limit']) ? intval($queryParam['limit']) : 12;
        $arrParams = [
            'page' => $currPage,
            'limit' => $limit
        ];
        if (isset($queryParam['keyword']) && !empty($queryParam['keyword'])) {
            $arrParams['keyword'] = $queryParam['keyword'];
        }
        if (isset($queryParam['country']) && !empty($queryParam['country'])) {
            $arrParams['country'] = $queryParam['country'];
        }
        if (isset($queryParam['category']) && !empty($queryParam['category'])) {
            $arrParams['category'] = $queryParam['category'];
        }
        if (isset($queryParam['type_cd']) && !empty($queryParam['type_cd'])) {
            $arrParams['type_cd'] = $queryParam['type_cd'];
        }
        if (isset($queryParam['is_hot']) && !empty($queryParam['is_hot'])) {
            $arrParams['is_hot'] = $queryParam['is_hot'];
        }
        if (isset($queryParam['is_promotion']) && !empty($queryParam['is_promotion'])) {
            $arrParams['is_promotion'] = $queryParam['is_promotion'];
        }
        $result = $this->api->listCampaignsForHtmlBuilder($arrParams);
        if ($result['status'] == true && isset($result['data'][0]['result'], $result['data'][0]['total'])) {
            $listCampaigns = $result['data'][0];
            // dd($listCampaigns);
        }

        //$result = $this->api->listCategory();

        // if ($result['status'] == true) {
        //     $listCategory = [];
        //     for($i = 0; $i < count($result['data']); $i++){
        //         $listCategory[$result['data'][$i]['id']] = $result['data'][$i];
        //     }
        // }

        if (isset($listCampaigns)) {

            $resultData = [
                'status' => true,
                'mess' => 'success',
                'data' => [
                    'listCampaignType' => ['product' => 'Product', 'web' => 'Web' , 'form' => 'Form' ],
                    'listCampaigns' => $listCampaigns,
                ]];
            return response()->json($resultData);

        }else{
            $resultData = [
                'status' => false,
                'mess' => 'error',
                'data' => []
            ];
            return response()->json($resultData);
        }

    }

    public function listProductsApi(Request $request){

        $param = $request->all();


        $dataList = [
            "page" => isset($param['page']) ? $param['page'] : 1 ,
            "limit" => isset($param['limit']) ? $param['limit'] : 10,
            'product_name' => isset($param['product_name']) ? $param['product_name'] : '',
            'campaign_id' => isset($param['campaign_id']) ? $param['campaign_id'] : '',
        ];

        $result = $this->api->listProductForHtmlBuilder($dataList);


        $listProduct = $result['status'] && isset($result['data'][0]) ? $result['data'][0] : [];

        if ($result['status']){
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data'=> $listProduct
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => __("error.error" . $result['code']),
            'data' => []
        ]);


    }

}
