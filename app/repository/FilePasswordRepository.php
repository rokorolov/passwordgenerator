<?php

namespace app\repository;

use app\contract\PasswordRepositoryInterface;

class FilePasswordRepository implements PasswordRepositoryInterface
{
    public function add($password)
    {
        $collection = $this->findAll();
        $collection[] = $password;

        return $this->store($collection);
    }

    public function findByPassword($password)
    {
        $collection = $this->findAll();

        if (in_array($password, $collection)) {
            return $password;
        }

        return null;
    }

    public function findAll()
    {
        return $this->restore();
    }

    private function store($collection)
    {
        return file_put_contents($this->path(), serialize($collection));
    }

    private function restore()
    {
        return (array)unserialize(file_get_contents($this->path()));
    }

    private function path()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'password_storage.bin';
    }
}