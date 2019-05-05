<?php


namespace App\Entities\Todolists;


use Carbon\Carbon;

class ItemData
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var Carbon
     */
    public $displayAfter;

    /**
     * @var array
     */
    public $labels = [];
}