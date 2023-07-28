<?php

namespace App\Repositories;

use App\Models\Faq;
// Use others
use Illuminate\Http\Request;

class FaqRepository
{
    protected $faq;

    /**
     * function construct
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Set model faq
     */
    public function setModel()
    {
        $this->faq = new Faq();
    }

    /**
     * Get all list faq
     * @return collection of list faq
     */
    public function getAll()
    {
        return $this->faq->all();
    }

    /**
     * Get one faq with id
     * @param int $id
     * @return object of faq
     */
    public function find($id)
    {
        return $this->faq->findOrFail($id);
    }

    /**
     * Create a new faq with list attributes
     * @param array $attributes
     * @return object of this faq has been created
     */
    public function create($attributes = [])
    {
        $result = $this->faq->create($attributes);
        return $result;
    }

    /**
     * Update a faq with id and list attributes
     * @param int $id
     * @param array $attributes
     * @return object of this faq has been updated
     */
    public function update($id, $attributes = [])
    {
        $result = $this->faq->findOrFail($id);
        return $result ?  $result->update($attributes) : null;
    }
}
