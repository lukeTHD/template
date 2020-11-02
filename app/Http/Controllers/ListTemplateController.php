<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListTemplate;
use URL;
use App\Http\Requests\StoreTemplate;
use App\Http\Requests\UpdateTemplate;
use App\Repositories\ListTemplateRepository;
use Illuminate\Support\Facades\Storage;

class ListTemplateController extends Controller
{
    protected $listTemplateRepository;

    public function __construct(ListTemplateRepository $listTemplateRepository)
    {
        $this->listTemplateRepository = $listTemplateRepository;
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

    public function detailsTemplate($code)
    {
        session()->put('tmp', 'edit');
        return view('template.edit_page');
    }


    public function showPage($code)
    {
        session()->forget('tmp');
        $link = 'landingpage.'. $code . '.index';
        return view($link);
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
}
