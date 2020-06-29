<?php

namespace HaymeTG\Buriza;

use League\CLImate\CLImate;

class Buriza {

    /**
     * @var damageRange
     */
    protected $damageRange;

    /**
     * @var cli
     */
    protected $cli;

    /**
     * @var critRate
     */
    protected $critRate;

    /**
     * @var critDamage
     */
    protected $critDamage;

    /**
     * Constructor for Buriza Item
     *
     * @param array damageRange
     * @param array critRate (1 - 100%, Whle Number)
     * @param array critDamage (Whole Number)
     *
     * @return void
     */
    public function __construct($damageRange = [1, 100], $critRate, $critDamage)
    {
        $this->cli = new CLImate;

        if (!is_array($damageRange)) {
            $this->cli->red('Damage range must be an array');
            exit;
        }

        if (!is_numeric($critRate))
        {
            $this->cli->red('Critical rate must be a number');
            exit;
        }

        if (!is_numeric($critDamage))
        {
            $this->cli->red('Critical damage must be a number');
            exit;
        }

        $this->damageRange = $damageRange;
        $this->critRate = $critRate;
        $this->critDamage = $critDamage;
    }

    /**
     *
     * Start attack!
     */
    public function launchAttack()
    {
        $normalDamage = rand($this->damageRange[0], $this->damageRange[1]);
        $critDamage = $normalDamage * ($this->critDamage / 100);
        $rnJesus = rand(1, 100);
        $isCrit = false;

        if ($rnJesus <= $this->critRate)
        {
            $isCrit = true;
        }

        if ($isCrit)
        {
            $this->cli->red('Critical hit: ');
            $this->cli->red($critDamage);
            return $critDamage;
        }

        $this->cli->blue('Normal Damage: ');
        $this->cli->blue($normalDamage);
        return $normalDamage;
    }
}
