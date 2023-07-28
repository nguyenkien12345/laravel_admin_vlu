<?php

namespace App\Repositories;

use App\Models\Program;

class ProgramRepository
{
    protected $program;

    /**
     * function construct
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Set model program
     */
    public function setModel()
    {
        $this->program = new Program();
    }

    /**
     * Get all list program
     * @return collection of list program
     */
    public function getAll()
    {
        return $this->program->all();
    }

    /**
     * Get one program with id
     * @param int $id
     * @return object of program
     */
    public function find($id)
    {
        return $this->program->findOrFail($id);
    }

    /**
     * Create a new program with list attributes
     * @param array $attributes
     * @return object of this program has been created
     */
    public function create($attributes = [])
    {
        $result = $this->program->create($attributes);
        return $result->count() > 0 ? true : false;
    }

    /**
     * Update a program with id and list attributes
     * @param int $id
     * @param array $attributes
     * @return object of this program has been updated
     */
    public function update($id, $attributes = [])
    {
        $result = $this->program->findOrFail($id);
        return $result ?  $result->update($attributes) : null;
    }

    /**
     * Check a program is exists
     * @param string name
     * @return true if program is exists, else return false
     */
    public function checkExists($name)
    {
        $result = $this->program->where('name', $name)->get();
        return $result->count() > 0 ? true : false;
    }
}
