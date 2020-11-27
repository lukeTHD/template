<?php

namespace App\Traits;

use App\User;

trait PaginationTrait
{
    protected $page = 1;

    protected $per_page = 10;

    protected $order_field = 'id';

    protected $order_sort = 'desc';

    protected $params = [];

    protected $query;

    protected $field_search = [];

    protected $func;

    protected $total;

    protected $meta;

    protected $results;

    protected $with;

    protected $where_field = 'status';

    protected $operator = '!=';

    protected $where_value = 2;

    protected $status = [
        'status' => true,
        'search' => true
    ];

    protected function getResults()
    {

        $this->init();

        return [$this->meta, $this->results];
    }

    protected function init()
    {
        $this->page();

        $this->per_page();

        $this->search();

        $this->status();

        $this->sort();

        $this->total();

        $this->results();

        $this->meta();

        $this->func();
    }

    protected function search()
    {
        if (isset($this->params['query']['generalSearch']) && $this->status['search']) {
            if ($this->field_search) {
                foreach ($this->field_search as $index => $field) {
                    if ($index === 0) {
                        $this->query->where($field, 'LIKE', "%" . $this->params['query']['generalSearch'] . "%");
                    } else {
                        $this->query->orWhere($field, 'LIKE', "%" . $this->params['query']['generalSearch'] . "%");
                    }
                }
            }

        }
    }

    protected function page()
    {
        if (isset($this->params['pagination']['page'])) {
            $this->page = $this->params['pagination']['page'];
        }
    }

    protected function per_page()
    {
        if (isset($this->params['pagination']['perpage'])) {
            $this->per_page = $this->params['pagination']['perpage'];
        }
    }

    protected function status()
    {
        if (isset($this->params['query'])) {
            foreach ($this->params['query'] as $key => $query) {
                if ($key !== 'generalSearch') $this->query->where($key, $query);
            }
        }
    }

    protected function sort()
    {
        if (isset($this->params['sort']['field'])) {
            $this->order_field = $this->params['sort']['field'];
            $this->order_sort = $this->params['sort']['sort'];
        }
    }

    protected function total()
    {
        $this->total = $this->query->where('status', '!=', 2)->limit($this->per_page)->count();
    }

    protected function results()
    {
        $query = $this->query->skip(($this->page - 1) * $this->per_page)
            ->take($this->per_page)->orderBy($this->order_field, $this->order_sort);
        if ($this->with) $query->with($this->with)->where('status', '!=', 2);
        $this->results = $query->get();
    }

    protected function meta()
    {
        $this->meta = [
            "page" => $this->page,
            "pages" => ceil($this->total / $this->per_page),
            "perpage" => $this->per_page,
            "total" => $this->total,
            "sort" => $this->order_sort,
            "field" => $this->order_field
        ];
    }

    protected function func()
    {
        if ($this->func) {
            foreach ($this->func as $func) {
                call_user_func($func, $this);
            }
        }
    }

    protected function trigger($func)
    {
        $this->func[] = $func;
    }

    protected function setStatus(string $key, bool $value)
    {
        if (isset($this->status[$key])) {
            $this->status[$key] = $value;
        }
    }
}
