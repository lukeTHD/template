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

            return view('template.edit_page', ['link' => $link, 'arrSection' => $arrSection, 'listSectionDefault' => $list_section_default , 'code' => $id]);
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
