<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function deleteRedis($key);

    public function setRedisAll($key, array $load);

    public function setRedisById($key, $data);

    public function where($id, $condition, $value);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);
}
