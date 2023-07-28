<?php

namespace App\Repositories;

use App\Models\Otp;
// Use Resource
use App\Http\Resources\OtpResource;

class OtpRepository
{
    protected $otp;

    /**
     * function construct
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Set model otp
     */
    public function setModel()
    {
        $this->otp = new Otp();
    }

    /**
     * Get all list otp
     * @return collection of list otp
     */
    public function getAll()
    {
        return $this->otp->all();
    }

    /**
     * Get one otp with id
     * @param int $id
     * @return object of otp
     */
    public function find($id)
    {
        return $this->otp->findOrFail($id);
    }

    /**
     * Create a new otp with list attributes
     * @param array $attributes
     * @return object of this otp has been created
     */
    public function create($attributes = [])
    {
        $result = $this->otp->create($attributes);
        return $result;
    }

    /**
     * Update a otp with id and list attributes
     * @param int $id
     * @param array $attributes
     * @return object of this otp has been updated
     */
    public function update($id, $attributes = [])
    {
        $result = $this->otp->findOrFail($id);
        return $result ?  $result->update($attributes) : null;
    }
}
