<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Districts\DistrictRepository;
use App\Http\Transformers\DistrictTransformer;

class DistrictController extends ApiController
{
    /**
     * DistrictController constructor.
     * @param DistrictRepository $district
     */
    public function __construct(DistrictRepository $district)
    {
        $this->district = $district;
        $this->setTransformer(new DistrictTransformer);
    }

    /**
     * Listing district by city
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->district->getByQuery($request->all(), $pageSize));
    }

    public function getByCity(Request $request, $id)
    {
        $id = (int)$id;
        return $this->successResponse($this->district->getByCity($id));
    }
}
