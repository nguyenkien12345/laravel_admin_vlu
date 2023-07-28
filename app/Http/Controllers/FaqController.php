<?php

namespace App\Http\Controllers;

// Use Repositories
use App\Repositories\FaqRepository;
// Use Services
use App\Services\FaqService;
// Use others
use Illuminate\Http\Request;

class FaqController
{
    protected $faqRepository;
    protected $faqService;

    public function __construct()
    {
        $this->faqRepository = new FaqRepository();
        $this->faqService = new FaqService();
    }

    public function index()
    {
        try {
            $faqs = $this->faqService->getAll();
            $tabs = config('content.faqs.tabs');
            $data = [
                'faqs' => $faqs,
                'tabs' => $tabs,
            ];
            return view('Faq.index', $data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
