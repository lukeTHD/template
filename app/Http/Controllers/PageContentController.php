<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PageContentRepository;
use App\Repositories\ListTemplateRepository;
use App\Helper\Api;

class PageContentController extends Controller
{
    protected $pageContentRepository;
    private $api;

    public function __construct(PageContentRepository $pageContentRepository, ListTemplateRepository $listTemplateRepository, Api $api)
    {
        $this->pageContentRepository = $pageContentRepository;
        $this->listTemplateRepository = $listTemplateRepository;
        $this->api = $api;
    }

    public function savePage(Request $request)
    {
        $param = $request->all();
        $id_user = 1;
        $id_page = 1;
        $data = [
            'status' => isset($param['status']) ? $param['status'] : 1,
            'id_user' => 1,
            'id_page' => isset($param['id']) ? $param['id'] : '',
            'name' => isset($param['name']) ? $param['name'] : '',
            'content' =>  isset($param['content']) ? json_encode($param['content']) : '',
            'list_product' =>  isset($param['list_product']) ? json_encode($param['list_product']) : '',
            'list_section' =>  isset($param['list_section']) ? json_encode($param['list_section']) : '',
        ];

        return $this->pageContentRepository->create($data);
    }

    public function updatePage(Request $request)
    {
        $param = $request->all();
        $id_user = 1;
        $id = isset($param['id']) ? $param['id'] : '';
        $data = [
            'status' => isset($param['status']) ? $param['status'] : 1,
            'id_user' => 1,
            'content' =>  isset($param['content']) ? json_encode($param['content']) : '',
            'list_product' =>  isset($param['list_product']) ? json_encode($param['list_product']) : '',
            'list_section' =>  isset($param['list_section']) ? json_encode($param['list_section']) : '',
        ];

        return $this->pageContentRepository->update($id, $data);
    }

    public function listPage()
    {
        $page_title = 'List Pages';
        $page_description = 'This is your list page';
        $list_page = $this->pageContentRepository->getAll();
        return view('list_page.list_page', compact('page_title', 'page_description', 'list_page'));
    }

    public function destroy($id)
    {
        $this->pageContentRepository->destroy($id);
        return back()->with('success', 'Xóa Page thành công');
    }

    public function showPage($id)
    {
        $page = $this->pageContentRepository->find($id);
        return $this->getListContent($page, $id);
    }

    public function showDetailProduct($id, $id_product)
    {
        $page = $this->pageContentRepository->find($id);
        if(!empty($page))
        {
            $template = $this->listTemplateRepository->findByID($page->id_page);
            $link = isset($template->code) ? './landingpage/page'.$template->code.'/index' : '';
            $list_section_default = isset($page->list_section) ? json_decode($page->list_section, true) : [];
            $list_product = isset($page->list_product) ? json_decode($page->list_product, true) : [];
            $listProduct = [];
            if(!empty($list_product))
            {
                foreach($list_product as $key => $value)
                {
                    $result = $this->api->getProductDetail($value);
                    $listProduct[] = $result['data'][0];
                }
            }
            $list_content = isset($page->content) ? json_decode($page->content, true) : [];

            $result = $this->api->getProductDetail($id_product);
            if(!$result['status']){
                return view('errors.404' , ['error' => __('error.error506')] );
            }
            $detailProduct = isset($result['data'][0]) ?  $result['data'][0] : [];

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

            return view('template.edit_page', ['link' => $link,'listSectionDefault' => $list_section_default ,
                    'id' => $id, 'preview' => true, 'previewPage' => true, 'list_content' => $list_content,
                    'listProduct' => $listProduct, 'detailProduct' => $detailProduct, 'listPaymentMethod' => $listPaymentMethod]);
        }
    }

    public function editPage($id)
    {
        $page = $this->pageContentRepository->find($id);
        if(!empty($page))
        {
            $template = $this->listTemplateRepository->findByID($page->id_page);
            $link = isset($template->code) ? './landingpage/page'.$template->code.'/index' : '';
            $list_section_default = isset($page->list_section) ? json_decode($page->list_section, true) : [];
            $list_product = isset($page->list_product) ? json_decode($page->list_product, true) : [];
            $listProduct = [];
            if(!empty($list_product))
            {
                foreach($list_product as $key => $value)
                {
                    $result = $this->api->getProductDetail($value);
                    $listProduct[] = $result['data'][0];
                }
            }
            $list_content = isset($page->content) ? json_decode($page->content, true) : [];
            return view('template.edit_page', ['link' => $link,'listSectionDefault' => $list_section_default ,
                    'id' => $id, 'code' => $page->id_page, 'editPage' => true , 'previewPage' => true, 'list_content' => $list_content,
                    'listProduct' => $listProduct]);
        }
    }

    public function getListContent($page, $id)
    {
        if(!empty($page))
        {
            $template = $this->listTemplateRepository->findByID($page->id_page);
            $link = isset($template->code) ? './landingpage/page'.$template->code.'/index' : '';
            $list_section_default = isset($page->list_section) ? json_decode($page->list_section, true) : [];
            $list_product = isset($page->list_product) ? json_decode($page->list_product, true) : [];
            $listProduct = [];
            if(!empty($list_product))
            {
                foreach($list_product as $key => $value)
                {
                    $result = $this->api->getProductDetail($value);
                    $listProduct[] = $result['data'][0];
                }
            }
            $list_content = isset($page->content) ? json_decode($page->content, true) : [];
            return view('template.edit_page', ['link' => $link,'listSectionDefault' => $list_section_default ,
                    'id' => $id, 'preview' => true, 'previewPage' => true, 'list_content' => $list_content,
                    'listProduct' => $listProduct]);
        }
    }

    public function getDetailPage($id)
    {
        $page = $this->pageContentRepository->find($id);
        if(!empty($page))
        {
            $list_content = isset($page->content) ? json_decode($page->content, true) : [];
        }
        return response()->json([
                    'code' => 0,
                    'status' => true,
                    'message' => 'success',
                    'list_content' => $list_content,
                    ]);
    }
}
