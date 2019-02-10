<?php

namespace Tests\Feature\Api\RestFulls;

use App\Repositories\Departments\Department;
class DepartmentRestFullTest extends RestFull
{
    protected $endpoint   = '/api/departments';
    protected $model      = \App\Repositories\Departments\Department::class;
    protected $table      = 'departments';
    protected $transform  = [
      'id'          ,
      'name'        ,
      'branch_id'   ,
      'status'      ,
    ];

    protected $seeder = [
        "name"        => "nguyen van anh",
        "branch_id"   => 1,
        "status"      => 0
    ];

    protected $seederObject = [
      "name" => " kjbhv",
      "branch_id" => 1,
      "status"  => 1
    ];

    protected $seederUpdate = [
      "name"        => "cuong nguyen",
      "branch_id"   => 1,
      "status"      => 1
    ];


    public function setUp()
    {
        parent::setUp();
        factory(\App\Repositories\Branches\Branch::class,4)->create();
    }

    public function statusProvider(){
        return [
            [
                'id'  => 10
            ],
            [
                'id'  => 11
            ]
        ];

    }

    public function storeOrUpdateFailedDataProvider(){
        return [
            [
                [
                    'status'      => 3
                ],
                [
                    'status'
                ]
            ],
            [
              [
                'name'          => '',
                'branch_id'       => ''
              ],
              [
                'name',
                'branch_id'
              ]
            ],
            [
              [
                'branch_id'         => 10
              ],
              [
                'branch_id',
              ]
            ]
        ];
    }

    public function testGetByBranch(){
        $this->json('GET', $this->endpoint . '/branch/1')
             ->seeStatusCode(200);
    }

    /**
     *  @dataProvider statusProvider
     * [testChangeStatus description]
     * @return [type] [description]
     */
    public function testChangeStatus($id){
        $this->json('PUT', $this->endpoint . '/change-status/' . $id)
               ->seeStatusCode(200)
               ->seeJsonStructure($this->successResponse(false));
        if($this->response->getData()->data->id == 10)
        {
            $this->assertEquals(1 , count($this->response->getData()));
        }
        if($this->response->getData()->data->id == 11)
        {
            $this->assertEquals(1 , count($this->response->getData()));
        }
    }

     /**
     * delete not found
     * should return 404
     */
     public function testDeleteNotFound(){
        $idNotFound = \DB::table($this->table)->count() + 1;
        $this->json('DELETE', $this->endpoint. '/' . $idNotFound)
        ->seeStatusCode(404)
        ->seeJsonStructure($this->deleteResponse());
    }



}
