<?php

namespace app\controller;
use app\contract\PasswordServiceInterface;
use app\base\BaseController;

/**
 * Description of PasswordController
 *
 * @author rkorolovs
 */
class PasswordController extends BaseController
{
    /**
     * @var PasswordServiceInterface
     */
    private $passwordService;

    /**
     * PasswordController constructor.
     * @param PasswordServiceInterface $passwordService
     */
    public function __construct(
        PasswordServiceInterface $passwordService
    ) {
        $this->passwordService = $passwordService;

        parent::__construct();
    }

    public function handle()
    {
        if ($this->isPasswordGenerateRequest()) {
            try {
                $password = $this->passwordService->generatePassword($_POST);
                return $this->view->view('password/index.php', ['password' => $password]);
            } catch (\LogicException $e) {
                return $this->view->view('password/index.php', ['error' => 'Some error occurred during password generation: ' . $e->getMessage()]);
            }
        }

        return $this->view->view('password/index.php');
    }

    private function isPasswordGenerateRequest()
    {
        return !empty($_POST) && isset($_POST['form']) && $_POST['form'] === 'passwordGeneratorForm';
    }
}
