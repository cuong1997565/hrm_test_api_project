<?php

namespace Tests\Feature\Api\RestFulls;

class PositionRestFullTest extends RestFull
{
    protected $endpoint = '/api/positions';
    protected $model    = \App\Repositories\Positions\Position::class;
    protected $transform = [
        'id',
        'name',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $table = 'positions';
    protected $seeder = [
        'name' => 'cuong nguyen'
    ];
    protected $seederUpdate = [
         'name' => 'cc'
    ];

    /**
     * seeder data insert, update,show
     * @var array
    */
    protected $seederObject = [
    'name' => 'bb'
    ];
    protected $resfullPermission = 'position';

    public function storeOrUpdateFailedDataProvider(){
        return [
            [
                [
                    'name'  => ''
                ],
                [
                    'name'
                ]
            ],
            [
                [
                    'name' => $this->seeder['name']
                ],
                [
                    'name'
                ]
            ]
        ];
    }

    public function updateStatusProvider(){
        return [
            [
                'id' => 12
            ],
            [
                'id' => 2
            ],
            [
                'id'  => 3
            ]
        ];
    }
    /**
     * test store not valid data
     * should return 422
     *  @dataProvider updateStatusProvider
    */
    public function testChangeStatus($id){
            $this->json('GET', $this->endpoint . '/' . $id)
                 ->seeStatusCode(200)
                 ->seeJsonStructure($this->successResponse(false));
            // dd($this->response->getData()->data);
            if($this->response->getData()->data->status == 1){
                $this->json('PUT', $this->endpoint . '/change-status/'. $this->response->getData()->data->id)
                     ->seeStatusCode(200)
                     ->seeJsonStructure($this->successResponse(false));
                     $this->assertEquals(0, $this->response->getData()->data->status);
            }else{
                $this->json('PUT', $this->endpoint . '/change-status/'. $this->response->getData()->data->id)
                     ->seeStatusCode(200)
                     ->seeJsonStructure($this->successResponse(false));
                     $this->assertEquals(1, $this->response->getData()->data->status);
            }
    }

}
