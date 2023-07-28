<?php

namespace App\Services;

// Use Repositories
use App\Repositories\FaqRepository;
// Use others
use Illuminate\Http\Request;

class FaqService
{
    protected $faqRepository;

    public function __construct()
    {
        $this->faqRepository = new FaqRepository();
    }

    public function getAll()
    {
        return $this->faqRepository->getAll();
    }

    public function add($data)
    {
        $this->faqRepository->create($data);
    }
}
