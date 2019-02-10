<?php

namespace Tests\Feature\Transformers;

class CityTransformerTest extends Transformer{
    protected $endpoint = 'api/cities';
    protected $model    = \App\Repositories\Cities\City::class;
    protected $params_transform_is_null = [
    'limit'     => 0,
    'q'         => 'sadasdasdasd',
    'include'   => 'branches'

    ];

    protected $seederObject = [
     'id'       => 1,
     'name'      => 'Da nang',
     'zipcode'   => 'sdasdasd',
     'slug'      =>'Da-nang',
    ];

    protected $transform = [
    'id',
    'name',
    'slug',
    'zipcode'
    ];

    protected $transformBranches = [
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

    public function belongsToDataProvider()
    {
        return [
            [
                [
                    [
                        'class' =>  \App\Repositories\Branches\Branch::class,
                        'init_data' => null,
                        'value'     => [
                            'id'    =>  $this->seederObject['id']
                        ]
                    ]
                ],
                [
                    'include'   => 'branches'
                ],
                [
                    'branches'  => [
                        'data'  => [
                            // 'data' => $this->transformCity
                        ]
                    ]
                ]
            ]
        ];
    }
}
