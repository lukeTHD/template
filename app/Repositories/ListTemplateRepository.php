<?php

namespace App\Repositories;

use App\ListTemplate;
use Illuminate\Support\Facades\DB;

class ListTemplateRepository
{
    public function getAll()
    {
        return ListTemplate::all();
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
        DB::beginTransaction();
        try {
            $template = new ListTemplate();
            $template->name = $request->name;
            $template->price = $request->price;
            $template->code = $request->code;
            $template->avatar = $this->getImg($request);
            $template->save();
            DB::commit();
            return $template;
        } catch (\Exception $ex) {
            DB::rollback();
            throw new $ex;
        }
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
