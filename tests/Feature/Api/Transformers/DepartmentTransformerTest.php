<?php

namespace Tests\Feature\Transformers;

class DepartmentTransformerTest extends Transformer{
    protected $endpoint = 'api/departments';
    protected $model    = \App\Repositories\Departments\Department::class;
    protected $params_transform_is_null = [
    'limit'     => 0,
    'q'         => 'sadasdasdasd',
    'include'   => 'branch,employees'
    ];

    protected $seederObject = [
    'id'        => 1,
    'name'      => 'nguyen van anh',
    'branch_id' => 1,
    'status'    => 0
    ];

    protected $transform = [
    'id',
    'name',
    'branch_id',
    'status'
    ];

    protected $transformBranch = [
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

    protected $transformEmployee = [
        'name',
        'qualification',
        'address',
        'email',
        'phone',
        'date_of_birth',
        'avatar',
        'gender',
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
                    'include'   => 'branch'
                ],
                [
                    'branch'  => [
                        'data'  => [
                            // 'data' => $this->transformCity
                        ]
                    ]
                ]
            ],
            [
                [
                    [
                        'class' =>  \App\Repositories\Employees\Employee::class,
                        'init_data' => null,
                        'value'     => [
                            'id'    =>  $this->seederObject['id']
                        ]
                    ]
                ],
                [
                    'include'   => 'employees'
                ],
                [
                    'employees'  => [
                        'data'  => [
                            // 'data' => $this->transformCity
                        ]
                    ]
                ]
            ]
        ];
    }



}
