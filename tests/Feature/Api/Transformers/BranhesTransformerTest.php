<?php

namespace Tests\Feature\Transformers;

class BranhesTransformerTest extends Transformer{
    protected $endpoint = 'api/branches';
    protected $model    = \App\Repositories\Branches\Branch::class;
    protected $params_transform_is_null = [
    'limit'     => 0,
    'q'         => 'sadasdasdasd',
    'include'   => 'city,district,departments'

    ];

    protected $seederObject = [
    "id"    => 1,
    "name"  => "Gulgowski, Carter and Grimes",
    "description" => "March Hare. 'It was the Hatter. 'I told you butter.",
    "about" => "Alice. 'Oh, don't talk about cats or dogs either, if you like!'",
    "phone" => "0215798083",
    "address" => "56316 Welch Plains Suite 514\nEast Corrinestad, FL 90864",
    "website" => "http:www.fahey.com\/voluptatum-eligendi-sunt-cons",
    "email" => "cuong1997@gmail.com",
    "facebook" => "facebook.com/Brown",
    "instagram" => "Yundt-Wisozk",
    "zalo" => "Barrows, Kunze and Schmidt",
    "tax_number" => "72907542",
    "bank" => "Nolan-Glover",
    "type" => 0,
    "city_id" => 1,
    "district_id" => 1,
    "status" => 1
    ];

    protected $transform = [
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

    protected $transformCity = [
    'id',
    'name',
    'slug',
    'zipcode'
    ];

    public function belongsToDataProvider()
    {
        return [
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
            ],
            [
                [
                    [
                        'class' =>  \App\Repositories\Districts\District::class,
                        'init_data' => null,
                        'value'     => [
                            'id'    =>  $this->seederObject['id']
                        ]
                    ]
                ],
                [
                    'include'   => 'district'
                ],
                [
                    'district'  => [
                        'data'  => [
                            // 'data' => $this->transformCity
                        ]
                    ]
                ]
            ],
            [
                [
                    [
                        'class' =>  \App\Repositories\Departments\Department::class,
                        'init_data' => null,
                        'value'     => [
                            'id'    =>  $this->seederObject['id']
                        ]
                    ]
                ],
                [
                    'include'   => 'departments'
                ],
                [
                    'departments'  => [
                        'data'  => [
                            // 'data' => $this->transformCity
                        ]
                    ]
                ]
            ]
        ];
    }
}
