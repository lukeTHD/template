<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListTemplate;
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
       // $link = 'landingpage.'. $code . '.index';

        //return view($link);
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
        // dd($request->image);
        // $path = $request->image->store('images');
        //$filename = $request->image->storeAs('images', $request->image->getClientOriginalName());
        $file->move('upload/images', $nameImg);
        $destinationPath = public_path('upload/images/'. $nameImg); //link path image
        $file_path = Config::get('app.url'); // http://yourhost.dev
        // dd($destinationPath);
        return ($file_path);
        // $gethinh = time().'_'.$imagePath;
        // $destinationPath = public_path('upload/avatar');
        // $hinhthe->move($destinationPath, $destinationPath);
        // $param = $request->all();
        // if ($request->hasFile()) {
        //     //  Let's do everything here
        //     if ($request->file()->isValid()) {
        //         //
        //         $validated = $request->validate([
        //             'name' => 'string|max:40',
        //             'image' => 'mimes:jpeg,png|max:1014',
        //         ]);
        //         if($validated->hasError()){
        //             return response()->json([
        //                 'status' => false,
        //                 'mess' => 'error',
        //                 'link' => ''
        //             ]);
        //         }
        //         $extension = $request->image->extension();
        //         $request->image->storeAs('/public', $validated['name'].".".$extension);
        //         $url = Storage::url($validated['name'].".".$extension);
        //         // $file = File::create([
        //         //    'name' => $validated['name'],
        //         //     'url' => $url,
        //         // ]);

        //         return response()->json([
        //             'status' => true,
        //             'mess' => 'success',
        //             'link' => $url
        //         ]);


        //     }
        // }
        // return response()->json([
        //     'status' => false,
        //     'mess' => 'error',
        //     'link' => ''
        // ]);
    }
}
