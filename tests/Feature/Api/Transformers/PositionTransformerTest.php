<?php

namespace Tests\Feature\Transformers;

class PositionTransformerTest extends Transformer{
    protected $endpoint         = 'api/positions';
    protected $model            = \App\Repositories\Positions\Position::class;
    protected $params_transform_is_null = [
        // 'include'   => 'employees , departments',
        'limit'     => 0,
        'q'         => 'sadasdasdasd'
    ];
    protected $seederObject = [
        'name'      => 'cuong nguyen',
        'id'        => 1
    ];

    protected $transform = [
        'id',
        'name',
        'status',
        'created_at'
    ];


    protected $transformEmployee = [
        'id',
        'name',
        'address',
        'email',
        'phone'
    ];






}