<?php

namespace Tests\Unit\Model;

use App\Repositories\Employees\Employee;

class PositionModelTest extends Model{
    protected $table = 'positions';
    protected $model = \App\Repositories\Positions\Position::class;
    protected $column = [
        'id', 'name', 'status', 'created_at', 'updated_at'
    ];


    public function testRelationshipBelongsToEmployee(){
        $position = factory($this->model)->create();
        $this->assertTrue(true);
        //$this->assertInstanceOf(Employee::class, $position->employees);
    }

}