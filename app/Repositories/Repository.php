<?php

namespace App\Repositories;

use Redis;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    public function setRedisAll($key, array $load) {
        if (!empty($load)) {
            $data = $this->model->all()->load($load);
        } else {
            $data = $this->model->all();
        }

        return Redis::set($key, json_encode($data));
    }

    public function setRedisById($key, $data)
    {
        return Redis::set($key, json_encode($data));
    }

    public function deleteRedis($key)
    {
        return Redis::del($key);
    }

    public function where($column, $condition, $value)
    {
        return $this->model->where($column, $condition, $value);
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
