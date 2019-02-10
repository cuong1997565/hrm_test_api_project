<?php

namespace App\Repositories\Positions;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Entity;

class Position extends Entity
{
    use FilterTrait, PresentationTrait;

    const ENABLE    = 1;
    const DISABLE   = 0;
    const ABC       = 2;

    const ALL_STATUS = [
        self::DISABLE,
        self::ENABLE,
        self::ABC
    ];
    const DISPLAY_STATUS = [
        self::DISABLE   => 'Không hiển thị',
        self::ENABLE    => 'Hiển thị',
        self::ABC       => 'ABC'
    ];

    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'name',
        'status'
    ];

    /**
     * Relationship with Employee
     */
    // public function employees()
    // {
    //     return $this->belongsToMany(\App\Repositories\Employees\Employee::class, 'department_employee');
    // }
}
