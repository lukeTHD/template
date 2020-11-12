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

    public function listPage()
    {
        $page_title = 'List Pages';
        $page_description = 'This is your list page';
        $list_page = $this->pageContentRepository->getAll();
        return view('list_page.list_page', compact('page_title', 'page_description', 'list_page'));
    }

    public function showPage($id)
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
                    'code' => $id, 'preview' => true, 'previewPage' => true, 'list_content' => $list_content,
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
