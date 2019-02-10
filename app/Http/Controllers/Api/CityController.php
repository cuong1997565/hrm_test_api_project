<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Cities\CityRepository;
use App\Http\Transformers\CityTransformer;

class CityController extends ApiController
{
    /**
     * CityController constructor.
     * @param CityRepository $city
     */
    public function __construct(CityRepository $city)
    {
        $this->city = $city;
        $this->setTransformer(new CityTransformer);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->city->getByQuery($request->all(), $pageSize));
        // return $this->successResponse($this->city->getAll($request->all()));
        // dd(123);
    }

    public function show($id)
    {
        try {
            return $this->successResponse($this->city->getById($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }
}
