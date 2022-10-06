<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IRecruitingActivityService;
use App\Interfaces\Eloquent\IRecruitingService;
use App\Models\Eloquent\Recruiting;
use App\Models\Eloquent\RecruitingStep;
use App\Models\Eloquent\RecruitingStepSubStepCheck;
use App\Services\ServiceResponse;

class RecruitingService implements IRecruitingService
{
    /**
     * @var RecruitingActivityService $recruitingActivityService
     */
    private $recruitingActivityService;

    /**
     * @param IRecruitingActivityService $recruitingActivityService
     */
    public function __construct(IRecruitingActivityService $recruitingActivityService)
    {
        $this->recruitingActivityService = $recruitingActivityService;
    }

    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All recruitings',
            200,
            Recruiting::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $recruiting = Recruiting::find($id);
        if ($recruiting) {
            return new ServiceResponse(
                true,
                'Recruiting',
                200,
                $recruiting
            );
        } else {
            return new ServiceResponse(
                false,
                'Recruiting not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     * @param int $userId
     * @param string|null $reason
     *
     * @return ServiceResponse
     */
    public function cancel(
        int     $id,
        int     $userId,
        ?string $reason
    ): ServiceResponse
    {
        $recruiting = $this->getById($id);
        if ($recruiting->isSuccess()) {
            $recruiting->getData()->cancel = 1;
            $recruiting->getData()->save();

            $createRecruitingActivityResponse = $this->recruitingActivityService->create(
                $recruiting->getData()->id,
                'İptal Edildi',
                $userId,
                $reason
            );

            if ($createRecruitingActivityResponse->isSuccess()) {
                return new ServiceResponse(
                    true,
                    'Recruiting canceled',
                    200,
                    $recruiting->getData()
                );
            } else {
                return $createRecruitingActivityResponse;
            }
        } else {
            return $recruiting;
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function reactivate(
        int $id
    ): ServiceResponse
    {
        $recruiting = $this->getById($id);
        if ($recruiting->isSuccess()) {
            $recruiting->getData()->cancel = 0;
            $recruiting->getData()->step_id = 1;
            $recruiting->getData()->save();
            return new ServiceResponse(
                true,
                'Recruiting reactivated',
                200,
                $recruiting->getData()
            );
        } else {
            return $recruiting;
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function wizard(
        int $id
    ): ServiceResponse
    {
        $response = [];
        $recruiting = Recruiting::find($id);
        $recruitingSteps = RecruitingStep::all();
        foreach ($recruitingSteps as $recruitingStep) {
            $recruitingStepSubStepChecks = RecruitingStepSubStepCheck::
            with([
                'recruitingStepSubStep'
            ])->
            where('recruiting_id', $recruiting->id)->
            where('recruiting_step_id', $recruitingStep->id)->
            get();
            $response[] = [
                'recruitingStepId' => $recruitingStep->id,
                'recruitingStepName' => $recruitingStep->name,
                'recruitingStepSubStepChecks' => $recruitingStepSubStepChecks
            ];
        }

        return new ServiceResponse(
            true,
            'Recruiting wizard',
            200,
            [
                'recruiting' => $recruiting,
                'recruitingSteps' => $response
            ]
        );
    }


    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $recruiting = $this->getById($id);
        if ($recruiting->isSuccess()) {
            return new ServiceResponse(
                true,
                'Recruiting deleted',
                200,
                $recruiting->getData()->delete()
            );
        } else {
            return $recruiting;
        }
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param array|null $departmentIds
     * @param array|null $stepIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array   $companyIds,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null,
        ?array  $departmentIds = [],
        ?array  $stepIds = []
    ): ServiceResponse
    {
        $recruitings = Recruiting::with([
            'company',
            'department',
            'step',
        ])->orderBy('id', 'desc')->whereIn('company_id', $companyIds);

        if ($keyword) {
            $recruitings->where(function ($recruitings) use ($keyword) {
                $recruitings->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('phone_number', 'like', '%' . $keyword . '%')
                    ->orWhere('identity', 'like', '%' . $keyword . '%');
            });
        }

        if ($departmentIds) {
            $recruitings->whereIn('department_id', $departmentIds);
        }

        if ($stepIds) {
            $recruitings->whereIn('step_id', $stepIds);
        }

        return new ServiceResponse(
            true,
            'Recruitings',
            200,
            [
                'totalCount' => $recruitings->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'recruitings' => $recruitings->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $companyId
     * @param int $departmentId
     * @param string $name
     * @param string $email
     * @param string $phoneNumber
     * @param string $identity
     * @param string $birthDate
     * @param int $obstacle
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        int    $departmentId,
        string $name,
        string $email,
        string $phoneNumber,
        string $identity,
        string $birthDate,
        int    $obstacle
    ): ServiceResponse
    {
        $recruiting = new Recruiting();
        $recruiting->company_id = $companyId;
        $recruiting->department_id = $departmentId;
        $recruiting->step_id = 1;
        $recruiting->name = $name;
        $recruiting->email = $email;
        $recruiting->phone_number = $phoneNumber;
        $recruiting->identity = $identity;
        $recruiting->birth_date = $birthDate;
        $recruiting->obstacle = $obstacle;
        $recruiting->save();
        return new ServiceResponse(
            true,
            'Recruiting created',
            201,
            $recruiting
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param int $departmentId
     * @param string $name
     * @param string $email
     * @param string $phoneNumber
     * @param string $identity
     * @param string $birthDate
     * @param int $obstacle
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        int    $departmentId,
        string $name,
        string $email,
        string $phoneNumber,
        string $identity,
        string $birthDate,
        int    $obstacle
    ): ServiceResponse
    {
        $recruiting = $this->getById($id);
        if ($recruiting->isSuccess()) {
            $recruiting->getData()->company_id = $companyId;
            $recruiting->getData()->department_id = $departmentId;
            $recruiting->getData()->name = $name;
            $recruiting->getData()->email = $email;
            $recruiting->getData()->phone_number = $phoneNumber;
            $recruiting->getData()->identity = $identity;
            $recruiting->getData()->birth_date = $birthDate;
            $recruiting->getData()->obstacle = $obstacle;
            $recruiting->getData()->save();
            return new ServiceResponse(
                true,
                'Recruiting updated',
                200,
                $recruiting->getData()
            );
        } else {
            return $recruiting;
        }
    }

    /**
     * @param int $id
     * @param int|string $cv
     */
    public function updateCv(
        int        $id,
        int|string $cv
    ): ServiceResponse
    {
        $recruiting = $this->getById($id);
        if ($recruiting->isSuccess()) {
            $recruiting->getData()->cv = $cv;
            $recruiting->getData()->save();
            return new ServiceResponse(
                true,
                'CV updated',
                200,
                $recruiting->getData()
            );
        } else {
            return $recruiting;
        }
    }
}
