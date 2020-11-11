<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListTemplate;
use URL;
use File;
use App\Http\Requests\StoreTemplate;
use App\Http\Requests\UpdateTemplate;
use App\Repositories\ListTemplateRepository;
use Illuminate\Support\Facades\Storage;
use App\Helper\Api;

class ListTemplateController extends Controller
{
    private $api;
    private $listCurrency;

    protected $listTemplateRepository;

    public function __construct(ListTemplateRepository $listTemplateRepository , Api $api)
    {
        $this->listTemplateRepository = $listTemplateRepository;
        $this->api = $api;
        $this->listCurrency = ['VND', 'USD'];
    }

    public function create()
    {
        $page_title = 'Add Template';
        return view('template.create', compact('page_title'));
    }

    public function store(StoreTemplate $storeTemplate)
    {
        $template = $this->listTemplateRepository->store($storeTemplate);
        return back()->with('success', 'Thêm Template thành công');
    }

    public function destroy($id)
    {
        $this->listTemplateRepository->destroy($id);
        return back()->with('success', 'Xóa Template thành công');
    }

    public function edit($id)
    {
        $page_title = 'Edit Template';
        $template = $this->listTemplateRepository->findByID($id);
        return view('template.edit', compact('page_title', 'template'));
    }

    public function update(UpdateTemplate $updateTemplate, $id)
    {
        $template = ListTemplate::find($id);
        if($updateTemplate->code != $template->code)
        {
            $code = ListTemplate::where('code', $updateTemplate->code)->get()->toArray();
            if($code)
            {
                return back()->with('error', 'Đường dẫn đã tồn tại. Vui lòng nhập đường dẫn khác!');
            }
        }
        $template = $this->listTemplateRepository->update($updateTemplate, $id);
        return back()->with('success', 'Cập nhật Template thành công');
    }

    public function listTemplate()
    {
        $page_title = 'List Template';
        $page_description = 'This is list template page';
        $list_template = $this->listTemplateRepository->getAll();

        return view('template.list_template', compact('page_title', 'page_description', 'list_template'));
    }

    public function detailsTemplate($id)
    {
        //Lấy danh sách các chiến dịch
        $dataGetListCampaign = [
            'limit' => 100,
            'page' => 1
        ];
        $listCampaignResult =  $this->api->listCampaignsForHtmlBuilder($dataGetListCampaign);
        $listCampaign = $listCampaignResult['status'] && !empty($listCampaignResult['data'][0]['result']) ? $listCampaignResult['data'][0]['result'] : [] ;
        //Lấy danh sách sản phẩm mặc định
        $dataGetDefaultListProduct = [
            "page" => isset($param['page']) ? $param['page'] : 1 ,
            "limit" => isset($param['limit']) ? $param['limit'] : 3,
        ];
        $listProductDefaultResult = $this->api->listProductForHtmlBuilder($dataGetDefaultListProduct);
        $listProductDefault = $listProductDefaultResult['status'] && !empty($listProductDefaultResult['data'][0]['result']) ? $listProductDefaultResult['data'][0]['result'] : [] ;

        // --------------------------------------Thoong tin san pham---------------------------------
        $result = $this->api->getProductDetail(65);

        if(!$result['status']){
            return view('errors.404' , ['error' => __('error.error506')] );
        }

        $detailProduct = isset($result['data'][0]) ?  $result['data'][0] : [];

        $data =[
            'product_id' => isset($product_id) ? $product_id : '',
            'campaign_id' => isset($campaign_id) ? $campaign_id : '',
            'user_code' => isset($affiliator) ? $affiliator : '',
        ];

        $resultPayment = $this->api->getListPaymentMethod();
        $listPaymentMethod = ($resultPayment['status'] == true) && isset($resultPayment['data']) ? $resultPayment['data'] : [];

        if( isset($detailProduct['type_cd']) && $detailProduct['type_cd'] == 'form'){
            foreach($listPaymentMethod as $key => $method){
                if($method['code'] == 'Request'){
                    $listPaymentMethod[$key]['name'] = 'Thanh Toán tại trung tâm' ;
                    $listPaymentMethod[$key]['name_en'] = 'Payment at the center' ;
                }
            }
        }

        // --------------------------------------Thoong tin san pham---------------------------------

        //Lấy chi tiết thông tin của page
        $template = ListTemplate::where('id', $id)->first();
        if(!empty($template))
        {
            $link = isset($template->code) ? './landingpage/page'.$template->code.'/index' : '';
            $total = isset($template->code) ? $this->countImages($template->code) : 0;
            $list_section_default = isset($template->list_section_default) ? json_decode($template->list_section_default, true) : [];
            $arrSection = [];
            $jpg = '.jpg';
            for($i=1; $i<=$total; $i++)
            {
                if(!in_array($i,$list_section_default))
                {
                    $sectiontmp = [
                        'page' => $template->code,
                        'section' => $i,
                        'img' => 'landingpage/page'.$template->code.'/images_section/section_'.$i.$jpg,
                    ];
                    array_push($arrSection,$sectiontmp);
                }
            }

            return view('template.edit_page', ['link' => $link, 'arrSection' => $arrSection, 'listSectionDefault' => $list_section_default , 'code' => $id , 'listCampaign' => $listCampaign , 'listProduct' => $listProductDefault , 'detailProduct' => $detailProduct , 'listPaymentMethod' => $listPaymentMethod]);
        }
        return back();
    }

    public function previewTemplate($id)
    {
        $template = ListTemplate::where('id', $id)->first();
        if(!empty($template))
        {
            $link = isset($template->code) ? './landingpage/page'.$template->code.'/index' : '';
            $list_section_default = isset($template->list_section_default) ? json_decode($template->list_section_default, true) : [];
            return view('template.edit_page', ['link' => $link,'listSectionDefault' => $list_section_default , 'code' => $id, 'preview' => true]);
        }else{
            return back();
        }
    }

    //Upload file type image

    public function upLoadFile(Request $request,$imagePath)
    {
        $file = $request->image;
        $nameImg = time().'_'.$request->image->getClientOriginalName();
        $file->move('upload/images', $nameImg);
        $destinationPath = public_path('upload/images/'. $nameImg); //link path image
        $link = URL::to('/upload/images').'/'. $nameImg;

        return response()->json([
                        'destinationPath' => $destinationPath,
                        'nameImg' => $nameImg,
                        'link' =>$link,
                    ]);
    }

    public function getDetailCodeSection( Request $request)
    {
        $param = $request->all();
        if(!isset($param['page']) || !isset($param['section']) ){
            return response()->json([
                'code' => 300,
                'status' => false,
                'message' => 'error',
                'data' => [],
            ]);
        }
        $path = 'landingpage.page'.$param['page'].'.sections.section_'.$param['section'];
        return response()->json([
            'code' => 0,
            'status' => true,
            'message' => 'success',
            'data' => view($path)->render(),
        ]);
    }

    public function getListSection(Request $request)
    {
        $param = $request->all();

        if(isset($param['code']) && isset($param['arr_section_used']))
        {
            $template = ListTemplate::where('id', $param['code'])->first();
            $code = !empty($template) && $template->code ?  trim($template->code) : '';
            $arrSectionUsed = $param['arr_section_used'];
            $total = isset($code) ? $this->countImages($code) : 0;
            $arrSection = [];
            $jpg = '.jpg';
            for($i=1; $i<=$total; $i++)
            {
                if(!in_array($i,$arrSectionUsed))
                {
                    $sectiontmp = [
                        'page' => $code,
                        'section' => $i,
                        'img' => 'landingpage/page'.$code.'/images_section/section_'.$i.$jpg,
                    ];
                    array_push($arrSection,$sectiontmp);
                }
            }
            return response()->json([
                'code' => 0,
                'status' => true,
                'message' => 'success',
                'data' => $arrSection,
            ]);
        }

    }

    public function countImages($code) {
        $files = File::files(public_path('landingpage/page'.$code.'/images_section'));
        $filecount = 0;

        if ($files !== false) {
            $filecount = count($files);
        }

        return $filecount;
    }
}
