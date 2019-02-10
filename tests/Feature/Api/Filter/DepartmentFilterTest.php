<?php

namespace Tests\Feature\Api\Filter;

class DepartmentFilterTest extends Filter
{
    protected $endpoint     = '/api/departments';
    protected $model        = \App\Repositories\Departments\Department::class;
    protected $seederObject = [
             'name'         => 'An Giang',
             'branch_id'    => 1,
             'status'       => 0
    ];

    protected $transform         = [
        'id',
        'name',
        'branch_id',
        'status'
    ];

    public function listtingFilterSearchProvider()
    {
        return [
            [
                [
                    'q'         => 'An Giang'
                ]
            ],
            [
                [
                    'q'         => ''
                ]
            ]
        ];
    }

    public function listtingFilterIdCityOrIdDistrictSearchProvider(){
               return [
            [
                [
                    'q'         => 'An Giang'
                ],
                [
                    'branch_id' => 1
                ],
                [
                    'status'    =>  0
                ],
                [
                    'id'        => 21
                ]
            ],
            [
                [
                    'q'         => ''
                ],
                [
                    'branch_id' => 1
                ],
                [
                    'status'    =>  ''
                ],
                [
                    'id'        => ''
                ]
            ],
            [
                [
                    'q'         => ''
                ],
                [
                    'branch_id' => ''
                ],
                [
                    'status'    =>  1
                ],
                [
                    'id'        => ''
                ]
            ],
            [
                [
                    'q'         => ''
                ],
                [
                    'branch_id' => ''
                ],
                [
                    'status'    =>  ''
                ],
                [
                    'id'        => 21
                ]
            ],

            [
                [
                    'q'         => ''
                ],
                [
                    'branch_id' => ''
                ],
                [
                    'status'    => ''
                ],
                [
                    'id'        => ''
                ]
            ]
        ];
    }

    public function listtingFilterNotIsSreachProvider(){
        return [
            [
                [
                    'q'         => 'asdasdasdasdasd'
                ],
                [
                    'limit'     => -1
                ]
            ],
            [
                [
                    'q'         => 'asdasdasdasdasd'
                ],
                [
                    'limit'     => 0
                ]
            ],
            [
                [
                    'q'         => ''
                ],
                [
                    'limit'     => 0
                ]
            ],
            [
                [
                    'q'         => 'An Giang'
                ],
                [
                    'limit'     => 0
                ]
            ],
            [
                [
                    'q'         => 'An Giang'
                ],
                [
                    'limit'     => -1
                ]
            ],
            [
                [
                    'q'     => ''
                ],
                [
                    'limit'     => -1
                ]
            ]
        ];

    }
    /**
     * @dataProvider listtingFilterIdCityOrIdDistrictSearchProvider
     * screach limit 0
     * @return [type]
     */
     public function testLysttingFilter($q, $branchId , $status , $id)
    {

        $param = http_build_query($q)  . '&' .  http_build_query($branchId) . '&' . http_build_query($status) . '&' . http_build_query($id);
        $this->json('GET', $this->endpoint . '?' . $param)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'code',
                'status',
                'data'  => [ $this->transform ],
                'meta'  => [
                    'pagination'
                ]
            ]);
    }



}
