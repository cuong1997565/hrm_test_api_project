<?php

namespace Tests\Feature\Api\Filter;

class PositionFilterTest extends Filter
{
    protected $endpoint     = '/api/positions';
    protected $model        = \App\Repositories\Positions\Position::class;
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
                    'q' => 'An Giang'
              ]
            ],
            [
              [
                     'q' =>  ''
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



}
