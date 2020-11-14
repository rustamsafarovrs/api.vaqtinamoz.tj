<?php
/**
 * @author Rustam Safarov (RS)
 * created 14.11.2020
 * (c) 2020 RS DevTeam.
 */

class City
{
    public $name;
    public $difference;

    public function __construct($name = null, $difference = null)
    {
        $this->name = $name;
        $this->difference = $difference;
    }
}