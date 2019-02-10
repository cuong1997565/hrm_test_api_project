<?php

namespace Tests\Feature\Transformers;

class DistrictTransformerTest extends Transformer
{
    protected $endpoint = 'api/districts';
    protected $model    = \App\Repositories\Districts\District::class;
    protected $params_transform_is_null = [
    'limit'     => 0,
    'q'         => 'sadasdasdasd',
    'include'   => 'branches,city'
    ];

    protected $seederObject = [
    "id"        => 1,
    "name"      => "Da nang",
    "slug"      => "Da-nang",
    "zipcode"   => "sdasdasd"
    ];

    protected $transform = [
    "id",
    "name",
    "slug",
    "zipcode",
    ];

    protected $transformBranches = [
        "name",
        "description",
        "about",
        "phone",
        "address",
        "website",
        "email",
        "facebook",
        "instagram",
        "zalo",
        "tax_number",
        "bank",
        "type",
        "city_id",
        "district_id",
        "status"
    ];

    protected $transformCity = [
        "id",
        "name",
        "slug",
        "zipcode"
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
            ],
            [
                [
                    [
                        'class' =>  \App\Repositories\Cities\City::class,
                        'init_data' => null,
                        'value'     => [
                            'id'    =>  $this->seederObject['id']
                        ]
                    ]
                ],
                [
                    'include'   => 'city'
                ],
                [
                    'city'  => [
                        'data'  => [
                            // 'data' => $this->transformCity
                        ]
                    ]
                ]
            ]
        ];
    }
}
