<?php

namespace app\service;

use app\contract\PasswordRepositoryInterface;
use app\contract\PasswordServiceInterface;

class PasswordService implements PasswordServiceInterface
{
    /**
     * @var PasswordGeneratorService
     */
    private $passwordGeneratorService;

    /**
     * @var PasswordRepositoryInterface
     */
    private $passwordRepository;

    /**
     * Password constructor.
     * @param PasswordGeneratorService $passwordGeneratorService
     * @param PasswordRepositoryInterface $passwordRepository
     */
    public function __construct(
        PasswordGeneratorService $passwordGeneratorService,
        PasswordRepositoryInterface $passwordRepository
    ) {
        $this->passwordGeneratorService = $passwordGeneratorService;
        $this->passwordRepository = $passwordRepository;
    }

    public function generatePassword($request)
    {
        $passwordGeneratorService = $this->passwordGeneratorService;
        $passwordGeneratorService->setPasswordLength($request['symbolLength']);

        if (isset($request['number'])) {
            $passwordGeneratorService->addStrategy(PasswordGeneratorService::STRATEGY_NUMBER);
        }
        if (isset($request['largeLetters'])) {
            $passwordGeneratorService->addStrategy(PasswordGeneratorService::STRATEGY_LARGE_LETTERS);
        }
        if (isset($request['smallLetters'])) {
            $passwordGeneratorService->addStrategy(PasswordGeneratorService::STRATEGY_SMALL_LETTERS);
        }

        return $this->getUniquePassword($passwordGeneratorService);
    }

    /**
     * @param PasswordGeneratorService $passwordGeneratorService
     * @return mixed
     */
    private function getUniquePassword($passwordGeneratorService)
    {
        if (!$password = $passwordGeneratorService->generate()) {
            return $password;
        }

        if (null === $this->passwordRepository->findByPassword($password)) {
            $this->passwordRepository->add($password);
            return $password;
        }

        return $this->getUniquePassword($passwordGeneratorService);
    }
}