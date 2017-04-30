<?php

namespace app\contract;

interface PasswordRepositoryInterface
{
    public function add($password);
    public function findByPassword($password);
    public function findAll();
}