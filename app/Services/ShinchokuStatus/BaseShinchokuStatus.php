<?php

namespace App\Services\ShinchokuStatus;


abstract class BaseShinchokuStatus implements ShinchokuStatus
{
    protected $shinchoku;
    protected $oldShinchoku;

    public function __construct($shinchoku, $oldShinchoku = null)
    {
        $this->shinchoku = $shinchoku;
        $this->oldShinchoku = $oldShinchoku;
    }
}
