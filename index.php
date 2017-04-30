<?php

use app\controller\PasswordController;
use app\repository\FilePasswordRepository;
use app\service\PasswordGeneratorService;
use app\service\PasswordService;

include_once 'autoload.php';

$passwordController = new PasswordController(
    new PasswordService(
        new PasswordGeneratorService(),
        new FilePasswordRepository()
    )
);

echo $passwordController->handle();