<?php

namespace  Tests\Feature\Api\Filter;

class BranchFilterTest extends Filter
{
    protected $endpoint     = '/api/branches';
    protected $model        = \App\Repositories\Branches\Branch::class;
    protected $seederObject = [
             'name'         => 'An Giang'
    ];

    protected $transform         = [
        'id',
        'name',
        'status',
        'created_at'
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
                    'cityId'    => 2
                ],
                [
                    'districtId' => 4
                ]
            ],
            [
                [
                    'q'         => ''
                ],
                [
                    'cityId'    => ''
                ],
                [
                    'districtId' => ''
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
     public function testLysttingFilter($q, $cityId, $districtId)
    {
       $param = http_build_query($q) . '&' . http_build_query($cityId) . '&' . http_build_query($districtId);
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
