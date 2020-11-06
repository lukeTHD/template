<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PageContentRepository;

class PageContentController extends Controller
{
    protected $pageContentRepository;

    public function __construct(PageContentRepository $pageContentRepository)
    {
        $this->pageContentRepository = $pageContentRepository;
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
        dd($this->pageContentRepository->findId($id));
    }
}
