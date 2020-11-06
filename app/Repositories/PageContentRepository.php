<?php

namespace App\Repositories;

use App\PageContent;
use Illuminate\Support\Facades\DB;

class PageContentRepository
{
    public function __construct(PageContent $PageContent){
        $this->PageContent = $PageContent;
    }

    public function getAll()
    {
        return $this->PageContent->all();

    }

    public function create(array $data)
    {
        $page = $this->PageContent->create($data);
        return $page;
    }

    public function find($id)
    {
        $page = $this->PageContent->find($id);
        return $page;
    }

}
