<?php

namespace app\contract;

interface PasswordServiceInterface
{
    public function generatePassword($request);
}