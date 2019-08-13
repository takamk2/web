<?php
/**
 * Created by PhpStorm.
 * User: t-mikami
 * Date: 2019/07/20
 * Time: 17:39
 */

namespace App\Services\ShinchokuStatus;


class ShokaiIrai extends BaseShinchokuStatus
{
    const ID = 1;

    public function __construct($shinchoku, $oldShinchoku = null)
    {
        parent::__construct($shinchoku, $oldShinchoku);
    }

    function update()
    {
    }
}
