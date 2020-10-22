<?php

namespace App\Http\Controllers;

use App\Repositories\FAQ\FAQInterface;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    //

    protected $faqRepository;

    public function __construct(FAQInterface $faqRepository)
    {
        can($this,'faq',['index','store']);
        $this->faqRepository = $faqRepository;
    }

    public function index() {
        $instance = $this->faqRepository->all()->toArray();
        $faqs = collect($instance)->map(function ($value) {
            return collect($value)->only(['answer', 'question'])->toArray();
        })->toJson();
        return view('admin.faqs.index', ['faqs' => $faqs]);
    }

    public function store(Request $request) {
        $faqs = collect(json_decode($request->faqs, true))->filter(function ($value) {
            return !empty($value['question']) && !empty($value['answer']);
        })->map(function ($value) {
            $value['created_at'] = now();
            return $value;
        })->toArray();

        $this->faqRepository->query()->forceDelete();
        $this->faqRepository->getModel()->insert($faqs);

        flash_message('success', 'Success');

        return back();
    }
}
