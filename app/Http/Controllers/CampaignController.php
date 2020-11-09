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

    public function listProductsApiTable(Request $request) {
 
        $param = $request->all();
        
        $validation = Validator::make($param, [
            "start" => 'required|numeric',
            "length" => 'required|numeric',
        ],[
            'required' =>  __('label.validation.required'),
        ]);
        if ($validation->fails()){
            return response()->json([
                'status' => true,
                'message' => "error",
                "aaData" => []
            ]);
        }

        if($param['start'] == 0  && $param['length'] > 0){
           $page = 1;
           $limit = $param['length'];
       }
       else{
           $page = ($param['start'] / $param['length'] ) +1 ;
           $limit = $param['length'];
       }
        // Get value to search 
        $arrsearch =[] ;
        if (isset($param['columns'][1]['search']['value'])){
           $encodeSearch = json_decode($param['columns'][1]['search']['value'], true);
           foreach( $encodeSearch as $key => $search){
               if(isset($search) ){ $arrsearch[$key] = $search ;}
           }
        }
        if(isset($param['order'][0]['column']) && isset($param['order'][0]['dir'])){
           $arrsearch['order_column'] = isset( $param['columns'][$param['order'][0]['column']]['data']) ?  $param['columns'][$param['order'][0]['column']]['data'] : '';
           $arrsearch['order_by'] = $param['order'][0]['dir'] ;
        }
        $dataList = [
           "page" => $page,
           "limit" => $limit,
           'keyword' => isset($arrsearch['keyword'])?$arrsearch['keyword']:'',
           "order_by" => isset($arrsearch['order_by'])? $arrsearch['order_by'] :'', 
           "order_column" => isset($arrsearch['order_column'])? $arrsearch['order_column'] :'', 
           'from_date' => isset($arrsearch['from_date'])?(date('yy-m-d 00:00:00', strtotime($arrsearch['from_date']))):'',
           'to_date' => isset($arrsearch['to_date'])? (date('yy-m-d 23:59:59', strtotime($arrsearch['to_date']))):'', 
           "status" => isset($arrsearch['status'])? $arrsearch['status'] :'',  
       ];

        $result = $this->api->listProductForHtmlBuilder($dataList);

        if (!$result['status']){
            return response()->json([
                'status' => true,
                'message' => __("error.error" . $result['code']),
            ]);
        }

        $resultData = $result['data'][0]['result'];

        // return result
        return response()->json([

            'status' => true,

            'message' => 'success',

            "iTotalDisplayRecords" => isset($result['data'][0]['total']) ? $result['data'][0]['total'] : 10,

            "iTotalRecords" => isset($result['data'][0]['total']) ? $result['data'][0]['total'] : 10,

            "aaData" => $resultData,

        ]);

    }

}
