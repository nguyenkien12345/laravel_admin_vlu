<?php

namespace App\Repositories;

use App\Http\Resources\AdmissionResource;
use App\Models\Admission;

class AdmissionRepository
{
    protected $admission;

    /**
     * function construct
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Set model admission
     */
    public function setModel()
    {
        $this->admission = new Admission();
    }

    /**
     * Get all list admission
     * @return collection of list admission
     */
    public function getAll()
    {
        $data = $this->admission->all();
        return AdmissionResource::collection($data);
    }

    /**
     * Get one admission with id
     * @param int $id
     * @return object of admission
     */
    public function find($id)
    {
        $data = $this->admission->findOrFail($id);
        return new AdmissionResource($data);
    }

    /**
     * Create a new admission with list attributes
     * @param array $attributes
     * @return object of this admission has been created
     */
    public function create($attributes = [])
    {
        $result = $this->admission->create($attributes);
        return $result->count() > 0 ? true : false;
    }

    /**
     * Update a admission with id and list attributes
     * @param int $id
     * @param array $attributes
     * @return object of this admission has been updated
     */
    public function update($id, $attributes = [])
    {
        $result = $this->admission->findOrFail($id);
        return $result ?  $result->update($attributes) : null;
    }

    /**
     * Check a admission is exists
     * @param string name
     * @return true if admission is exists, else return false
     */
    public function checkExists($name)
    {
        $result = $this->admission->where('name', $name)->get();
        return $result->count() > 0 ? true : false;
    }
}
