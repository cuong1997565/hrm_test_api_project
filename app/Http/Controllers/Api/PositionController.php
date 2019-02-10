<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Positions\PositionRepository;
use Illuminate\Http\Request;
use App\Http\Transformers\PositionTransformer;

class PositionController extends ApiController
{
    protected $validationRules = [
        'name'        => 'required|unique:positions,name',
        'status' => 'in:'
    ];
    protected $validationMessages = [
       'name.required' => 'Tên chức danh không được để trống',
        'name.unique'   => 'Tên chức danh đã tồn tại trên hệ thống',
        'status.in'     => 'Trạng thái không hợp lệ',
    ];
    /**
     * RoleController constructor.
     * @param RoleRepository $role
     */
    public function __construct(PositionRepository $position)
    {
        $this->position = $position;
        $this->setTransformer(new PositionTransformer);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->position->getByQuery($request->all(), $pageSize));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function show(Request $request, $id)
    {
        try {
            return $this->successResponse($this->position->getById($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             return $this->notFoundResponse();
        } catch (\Exception $e){
              throw $e;
        } catch (\Throwable $t){
               throw $t;

        }
    }

    public function store(Request $request)
    {
         $this->validationRules['status'] .= $this->position->getAllStatus();
        try {
              $this->validate($request, $this->validationRules, $this->validationMessages);
              $data = $this->position->store($request->all());
              return $this->successResponse($data);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t){
            throw $t;
        }
    }

    public function update(Request $request, $id)
    {
        $this->validationRules['status'] .= $this->position->getAllStatus();
        $this->validationRules['name'] .= ',' . $id;
        try {
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $model = $this->position->update($id, $request->all());
            return $this->successResponse($model);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }

    public function changeStatus($id){
        try {
           $data = $this->position->changeStatus($id);
           return $this->successResponse($data);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return $this->notFoundResponse();
        } catch (\Exception $e){
            throw $e;
        }


    }

    public function destroy($id)
    {
        try{
            $this->position->delete($id);
            return $this->deleteResponse();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }
}
