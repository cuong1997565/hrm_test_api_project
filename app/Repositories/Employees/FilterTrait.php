<?php

namespace App\Repositories\Employees;

use App\Repositories\Departments\DepartmentRepository;
use App\Repositories\Positions\PositionRepository;
use App\Repositories\Contracts\ContractRepository;

trait FilterTrait
{
    /**
    * Tìm kiếm theo tên, email, mã nhân viên, số điện thoại
    * @param  [type] $query [description]
    * @param  string $q     name, email, code, phone
    * @return Collection Employee Model
    */
    public function scopeQ($query, $q)
    {
        if ($q) {
            return $query->where('name', 'like', "%${q}%")
            ->orWhere('email', 'like', "%${q}%")
            ->orWhere('code', 'like', "%${q}%")
            ->orWhere('phone', 'like', "%${q}%");
        }
        return $query;
    }

    /**
     * Tìm kiếm theo ngày sinh
     * @param  [type] $query         [description]
     * @param  int[1-31] $dayOfBirth [description]
     * @return Collection Employee Model
     */
    public function scopeDateOfBirth($query, $dateOfBirth)
    {
        if ($dateOfBirth) {
            return $query->where('date_of_birth', $dateOfBirth);
        }
        return $query;
    }

    /**
     * Tìm kiếm theo tháng sinh
     * @param  [type] $query              [description]
     * @param  int[1-12] $monthOfBirth    [description]
     * @return Collection Employee Model
     */
    public function scopeMonthOfBirth($query, $monthOfBirth)
    {
        if (is_numeric($monthOfBirth)) {
            return $query->whereMonth('date_of_birth', $monthOfBirth);
        }
        return $query;
    }

    /**
     * Tìm kiếm theo trạng thái
     * @param  [type] $query  [description]
     * @param  int $status    status
     * @return [type]         [description]
     */
    public function scopeStatus($query, $status)
    {
        if (is_numeric($status)) {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Tìm kiếm theo chi nhánh
     * @param  [type] $query        [description]
     * @param  int    $branchId     branchId
     * @return Collection Employee Model
     */
    public function scopeBranchID($query, $branchId)
    {
        if (is_numeric($branchId)) {
            $departments = app()->make(DepartmentRepository::class)
            ->getByQuery(['branch_id' => $branchId], -1)
            ->pluck('id');

            return $query->whereHas('departments', function ($query) use ($departments) {
                $query->whereIn('id', $departments);
            });
        }
        return $query;
    }

    /**
    * Tìm kiếm theo phòng ban
    * @param  [type] $query        [description]
    * @param  int $departmentId     departmentId
    * @return Collection Employee Model
    */
    public function scopeDepartmentID($query, $departmentId)
    {
        if (is_numeric($departmentId)) {
            $departments = app()->make(DepartmentRepository::class)
            ->getByQuery(['id' => $departmentId], -1)
            ->pluck('id');

            return $query->whereHas('departments', function ($query) use ($departments) {
                $query->whereIn('id', $departments);
            });
        }
        return $query;
    }

    /**
     * Tìm kiếm theo chức danh
     * @param  [type] $query        [description]
     * @param  int    $positionId   positionId
     * @return Collection Employee Model
     */
    public function scopePositionID($query, $positionId)
    {
        if (is_numeric($positionId)) {
            $positions = app()->make(PositionRepository::class)
            ->getByQuery(['id' => $positionId], -1)
            ->pluck('id');

            return $query->whereHas('positions', function ($query) use ($positions) {
                $query->whereIn('id', $positions);
            });
        }
        return $query;
    }

    /**
     * Tìm kiếm theo loại hợp đồng
     * @param  [type] $query        [description]
     * @param  int $contractType    type
     * @return [type]               [description]
     */
    public function scopeContractType($query, $contractType)
    {
        if (is_numeric($contractType)) {
            $contracts = app()->make(ContractRepository::class)
            ->getByQuery(['type' => $contractType], -1)
            ->pluck('employee_id');

            return $query->whereHas('contracts', function ($query) use ($contracts) {
                $query->whereIn('employee_id', $contracts);
            });
        }
        return $query;
    }

    /**
     * Tìm kiếm theo ngày vào công ty
     * là ngày có hiệu lực của bản hợp đồng đầu tiên
     * @param  [type] $query        [description]
     * @param  [type] $dateOfFirstContract [description]
     * @return [type]               [description]
     */
    public function scopeDateOfFirstContract($query, $dateOfFirstContract)
    {
        /*
        SELECT employee_id, MIN(date_effective)
        FROM hrm_new.contracts
        GROUP BY employee_id
        HAVING MIN(date_effective)=$dateOfFirstContract
         */

        if ($dateOfFirstContract) {
            $contracts = app()->make(ContractRepository::class)
            ->getByQuery(['DateOfFirstContract' => $dateOfFirstContract], -1)
            ->pluck('employee_id');

            return $query->whereHas('contracts', function ($query) use ($contracts) {
                $query->whereIn('employee_id', $contracts);
            });
        }
        return $query;
    }


    /**
     * Tìm kiếm theo ngày/tháng/năm sinh
     * nằm trong khoảng [$dateOfBirthStart, $dateOfBirthEnd]
     * @param  [type] $query                [description]
     * @param  date $dateOfBirthStart     date_of_birth
     * @return Collection Employee Model
     */
    // public function scopeDateOfBirthStart($query, $dateOfBirthStart)
    // {
    //     if ($dateOfBirthStart) {
    //         return $query->where('date_of_birth', '>=', $dateOfBirthStart);
    //     }
    //     return $query;
    // }

    /**
     * Tìm kiếm theo ngày/tháng/năm sinh
     * nằm trong khoảng [$dateOfBirthStart, $dateOfBirthEnd]
     * @param  [type] $query            [description]
     * @param  date $dateOfBirthEnd     date_of_birth
     * @return Collection Employee Model
     */
    // public function scopeDateOfBirthEnd($query, $dateOfBirthEnd)
    // {
    //     if ($dateOfBirthEnd) {
    //         return $query->where('date_of_birth', '<=', $dateOfBirthEnd);
    //     }
    //     return $query;
    // }

    /**
     * Tìm kiếm theo năm sinh
     * @param  [type] $query       [description]
     * @param  int $yearOfBirth    [description]
     * @return Collection Employee Model
     */
    // public function scopeYearOfBirth($query, $yearOfBirth)
    // {
    //     if (is_numeric($yearOfBirth)) {
    //         return $query->whereYear('date_of_birth', $yearOfBirth);
    //     }
    //     return $query;
    // }
}
