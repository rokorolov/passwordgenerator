<?php

namespace app\service;

/**
 * Description of PasswordGeneratorService
 *
 * @author rkorolovs
 */
class PasswordGeneratorService
{
    const STRATEGY_NUMBER = 1;
    const STRATEGY_LARGE_LETTERS = 2;
    const STRATEGY_SMALL_LETTERS = 3;

    const DEFAULT_PASSWORD_LENGTH = 10;

    private $passwordLength;
    private $strategy = [];

    public function generate()
    {
        $strategies = $this->getStrategy();
        $strategyCount = count($strategies);
        $passwordLength = $this->getPasswordLength();

        $i = 1;
        $password = '';
        $strategySymbolLength = 0;

        foreach ($strategies as $strategy) {

            if ($i === $strategyCount) {
                $strategySymbolLength = $passwordLength - strlen($password);
            } else {
                $strategySymbolLength = rand(1, $passwordLength - $strategySymbolLength - ($strategyCount - $i));
            }

            $password .= substr($this->getStrategyRelevantSymbol($strategy), 0, $strategySymbolLength);

            $i++;
        }

        return str_shuffle($password);
    }

    public function addStrategy($strategy)
    {
        $this->strategy[] = $strategy;

        return $this;
    }

    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function setPasswordLength($passwordLength)
    {
        $this->passwordLength = $passwordLength;

        return $this;
    }

    private function getPasswordLength()
    {
        if (null === $this->passwordLength) {
            $this->passwordLength = self::DEFAULT_PASSWORD_LENGTH;
        }

        return $this->passwordLength;
    }

    private function getStrategyRelevantSymbol($strategy)
    {
        $strategySymbolOption = $this->getStrategyRelevantSymbolOption();

        if (array_key_exists($strategy, $strategySymbolOption)) {
            return $strategySymbolOption[$strategy];
        }

        throw new \LogicException('Password generator strategy - ' . $strategy . ' not exist.');
    }

    private function getStrategyRelevantSymbolOption()
    {
        return [
            self::STRATEGY_NUMBER => $this->getNumberStrategySymbol(),
            self::STRATEGY_SMALL_LETTERS => $this->getSmallLetterStrategySymbol(),
            self::STRATEGY_LARGE_LETTERS => $this->getLargeLetterStrategySymbol(),
        ];
    }

    private function getStrategy()
    {
        return (array)$this->strategy;
    }

    private function getNumberStrategySymbol()
    {
        return '1234567890';
    }

    private function getSmallLetterStrategySymbol()
    {
        return 'abcdefghijklmnopqrstuvwxyz';
    }

    private function getLargeLetterStrategySymbol()
    {
        return 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
}
