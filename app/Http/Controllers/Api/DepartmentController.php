<?php


namespace App\Http\Controllers\Api;

use DB;
use Illuminate\Http\Request;
use App\Repositories\Departments\Department;
use App\Repositories\Departments\DepartmentRepository;
use App\Http\Transformers\DepartmentTransformer;

class DepartmentController extends ApiController
{
    protected $validationRules = [
        'name'      => 'required',
        'branch_id' => 'required|exists:branches,id',
        'status'    => 'in:',
    ];
    protected $validationMessages = [
        'name.required'      => 'Tên phòng ban không được để trống',
        'branch_id.required' => 'Vui lòng chọn chi nhánh',
        'branch_id.exists'   => 'Chi nhánh không tồn tại trên hệ thống',
        'status.in'          => 'Trạng thái không hợp lệ',
    ];


    /**
     * BranchController constructor.
     * @param DepartmentRepository $department
     */
    public function __construct(DepartmentRepository $department)
    {
        $this->department = $department;
        $this->setTransformer(new DepartmentTransformer);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->get('limit', 25);
        return $this->successResponse($this->department->getByQuery($request->all(), $pageSize));
    }

    public function changeStatus($id)
    {
        try {
            $data = $this->department->changeStatus($id);
            return $this->successResponse($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }
     public function getByBranch(Request $request, $id)
    {
        $id = (int)$id;
        return $this->successResponse($this->department->getByBranch($id));
    }

    public function show($id)
    {
        try {
            return $this->successResponse($this->department->getById($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse();
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }

    }

    public function store(Request $request)
    {
        $this->validationRules['status'] .= $this->department->getAllStatus();
        try {
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $data = $this->department->store($request->all());

            return $this->successResponse($data);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this->errorResponse([
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage()
            ]);
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }

    }

    public function update($id, Request $request)
    {
        $this->validationRules['status'] .= $this->department->getAllStatus();
        try {
            $this->validate($request, $this->validationRules, $this->validationMessages);
            $model = $this->department->update($id, $request->all());
            return $this->successResponse($model);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return $this    ->errorResponse([
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

    public function destroy($id)
    {
        try {
            $this->department->delete($id);
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
