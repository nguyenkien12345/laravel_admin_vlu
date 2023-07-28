<?php

namespace App\Repositories;

use App\Models\AdmissionsTime;

class AdmissionTimeRepository
{
    protected $admissionTime;

    /**
     * function construct
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Set model admissionTime
     */
    public function setModel()
    {
        $this->admissionTime = new AdmissionsTime();
    }

    /**
     * Get all list admissionTime
     * @return collection of list admissionTime
     */
    public function getAll()
    {
        $data = $this->admissionTime->all();
        return  $data;
    }

    /**
     * Get one admissionTime with id
     * @param int $id
     * @return object of admissionTime
     */
    public function find($id)
    {
        $data = $this->admissionTime->findOrFail($id);
        return  $data;
    }

    /**
     * Create a new admissionTime with list attributes
     * @param array $attributes
     * @return object of this admissionTime has been created
     */
    public function create($attributes = [])
    {
        $result = $this->admissionTime->create($attributes);
        return $result->count() > 0 ? true : false;
    }

    /**
     * Update a admissionTime with id and list attributes
     * @param int $id
     * @param array $attributes
     * @return object of this admissionTime has been updated
     */
    public function update($id, $attributes = [])
    {
        $result = $this->admissionTime->findOrFail($id);
        return $result ?  $result->update($attributes) : null;
    }
}
