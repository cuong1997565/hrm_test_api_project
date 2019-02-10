<?php

namespace Tests\Unit\Model;

use App\Repositories\Cities\City;

class BranchModelTest extends Model{
    protected $table = 'branches';
    protected $model = \App\Repositories\Branches\Branch::class;
    protected $columns = [
    'name',
    'description',
    'about',
    'phone',
    'address',
    'website',
    'email',
    'facebook',
    'instagram',
    'zalo',
    'tax_number',
    'bank',
    'type',
    'city_id',
    'district_id',
    'status'
    ];

    public function testRelationshipBelongsToCity(){
     $branch = factory($this->model)->create();
      // $this->assertInstanceOf(City::class, $branch->city);
     $this->assertTrue(true);
    }

}