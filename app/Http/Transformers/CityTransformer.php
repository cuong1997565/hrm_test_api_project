<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Cities\City;

class CityTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'branches'
    ];

    public function transform(City $city = null)
    {
        if (is_null($city)) {
            return [];
        }

        return [
            'id'      => $city->id,
            'name'    => $city->name,
            'slug'    => $city->slug,
            'zipcode' => $city->zipcode,
            // 'order'   => $city->order,
            'status'  => $city->status
        ];
    }

    // public function includeDistricts(City $city = null)
    // {
    //     if (is_null($city)) {
    //         return $this->null();
    //     }

    //     return $this->collection($city->districts, new DistrictTransformer);
    // }

    public function includeBranches(City $city = null)
    {
        if (is_null($city)) {
            dd(333);
            return $this->null();
        }

        return $this->collection($city->branches, new BranchTransformer);
    }
}
