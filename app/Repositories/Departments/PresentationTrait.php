<?php

namespace App\Repositories\Departments;

trait PresentationTrait
{
	/**
	 * [getStatus description]
	 * @return [type] [description]
	 */
    public function getStatus()
    {
        return self::DISPLAY_STATUS[$this->status ?? self::DISABLE];
    }
}
