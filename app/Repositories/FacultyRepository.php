<?php

namespace App\Repositories;

use App\Models\Faculty;

class FacultyRepository
{
    protected $faculty;

    /**
     * function construct
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Set model faculty
     */
    public function setModel()
    {
        $this->faculty = new Faculty();
    }

    /**
     * Get all list faculty
     * @return collection of list faculty
     */
    public function getAll()
    {
        return $this->faculty->all();
    }

    /**
     * Get one faculty with id
     * @param int $id
     * @return object of faculty
     */
    public function find($id)
    {
        return $this->faculty->findOrFail($id);
    }

    /**
     * Create a new faculty with list attributes
     * @param array $attributes
     * @return object of this faculty has been created
     */
    public function create($attributes = [])
    {
        $result = $this->faculty->create($attributes);
        return $result->count() > 0 ? true : false;
    }

    /**
     * Update a faculty with id and list attributes
     * @param int $id
     * @param array $attributes
     * @return object of this faculty has been updated
     */
    public function update($id, $attributes = [])
    {
        $result = $this->faculty->findOrFail($id);
        return $result ?  $result->update($attributes) : null;
    }

    /**
     * Check a faculty is exists
     * @param string name
     * @return true if faculty is exists, else return false
     */
    public function checkExists($name)
    {
        $result = $this->faculty->where('name', $name)->get();
        return $result->count() > 0 ? true : false;
    }
}
