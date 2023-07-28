<?php

namespace App\Repositories;

use App\Models\User;
use App\Http\Resources\AuthenticationResource;

class AuthenticationRepository
{
    protected $user;

    /**
     * function construct
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Set model user
     */
    public function setModel()
    {
        $this->user = new User();
    }

    /**
     * Get all list user
     * @return collection of list user
     */
    public function getAll()
    {
        $data = $this->user->all();
        return $data;
    }

    /**
     * Get one user with id
     * @param int $id
     * @return object of user
     */
    public function find($id)
    {
        $data = $this->user->findOrFail($id);
        return $data;
    }

    /**
     * Create a new user with list attributes
     * @param array $attributes
     * @return object of this user has been created
     */
    public function create($attributes = [])
    {
        $result = $this->user->create($attributes);
        return $result->count() > 0 ? true : false;
    }

    /**
     * Update a user with id and list attributes
     * @param int $id
     * @param array $attributes
     * @return object of this user has been updated
     */
    public function update($id, $attributes = [])
    {
        $result = $this->user->findOrFail($id);
        return $result ?  $result->update($attributes) : null;
    }

    /**
     * Check a user is exists
     * @param string name
     * @return true if user is exists, else return false
     */
    public function checkExists($type = null,  $value = null)
    {
        $result = null;
        switch ($type) {
            case 'name':
                $result = $this->user->where('name', $value);
                break;
            case 'phone':
                $result = $this->user->where('phone', $value);
                break;
            case 'nid':
                $result = $this->user->where('identity_number', $value);
                break;
            case 'all':
                $result = $this->user->where('name', $value['name'])->orWhere('phone', $value['phone'])->orWhere('nid', $value['nid']);
                break;
        }
        $result = $result->first();
        return $result;
    }
}
