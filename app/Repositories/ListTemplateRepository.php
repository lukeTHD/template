<?php

namespace App\Repositories;

use App\ListTemplate;
use Illuminate\Support\Facades\DB;

class ListTemplateRepository
{
    public function getAll()
    {
        return ListTemplate::paginate(3);;
    }

    public function findByID($id)
    {
        return ListTemplate::find($id);
    }

    public function destroy($id)
    {
        $template = ListTemplate::find($id);
        $template->delete();
    }

    public function store($request)
    {
        $template = new ListTemplate();
        $template->name = $request->name;
        $template->price = $request->price;
        $template->code = $request->code;
        $list_section = $request->section;
        $array_list_section = [];
        foreach ($list_section as $key => $value) {
            if($key == ceil(count($list_section)/2))
            {
                $array_list_section [] = "14";
                $array_list_section [] = "16";
            }
            $array_list_section [] = $value;
        }
        $template->list_section_default = json_encode($array_list_section);
        $template->avatar = $this->getImg($request);
        $template->save();
        return $template;
    }

    public function update($request, $id)
    {
        $template = ListTemplate::find($id);
        $template->name = $request->name;
        $template->price = $request->price;
        $template->code = $request->code;
        if($request->hasFile('avatar')){
            if(file_exists('upload/avatar/'.$template->avatar)){
                unlink('upload/avatar/'.$template->avatar);
            }
            $template->avatar = $this->getImg($request);
        }
        $list_section = $request->section;
        $array_list_section = [];
        foreach ($list_section as $key => $value) {
            if($key == ceil(count($list_section)/2))
            {
                $array_list_section [] = "14";
                $array_list_section [] = "16";
            }
            $array_list_section [] = $value;
        }
        $template->list_section_default = json_encode($array_list_section);
        $template->save();
        return $template;
    }

    public function getImg($requestImg)
    {
        $hinhthe = $requestImg->file('avatar');
        $gethinhthe = time().'_'.$hinhthe->getClientOriginalName();
        $destinationPath = public_path('upload/avatar');
        $hinhthe->move($destinationPath, $gethinhthe);
        return $gethinhthe;
    }
}
