<?php

namespace Tests\Feature\Api\RestFulls;

use App\Repositories\Employees\Employee;
use App\Repositories\Employees\EmployeeRepository;
class EmployeeRestFullTest extends RestFull
{
    protected $endpoint = '/api/employees';
    protected $model    = \App\Repositories\Employees\Employee::class;
    protected $table = 'employees';
    protected $transform = [
    'name',
    'qualification',
    'address',
    'phone',
    'gender',
    'date_of_birth',
    'email',
    'avatar',
    'status'
    ];

    public function testListEmployee(){

    }

}
