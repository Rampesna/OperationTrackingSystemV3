<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IRecruitingService;
use App\Http\Requests\Api\User\RecruitingController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\RecruitingController\GetByIdRequest;
use App\Http\Requests\Api\User\RecruitingController\WizardRequest;
use App\Http\Requests\Api\User\RecruitingController\CreateRequest;
use App\Http\Requests\Api\User\RecruitingController\UpdateRequest;
use App\Http\Requests\Api\User\RecruitingController\SendSmsRequest;
use App\Http\Requests\Api\User\RecruitingController\CancelRequest;
use App\Http\Requests\Api\User\RecruitingController\ReactivateRequest;
use App\Http\Requests\Api\User\RecruitingController\SetStepRequest;
use App\Http\Requests\Api\User\RecruitingController\NextStepRequest;
use App\Http\Requests\Api\User\RecruitingController\DeleteRequest;
use App\Models\Eloquent\Recruiting;
use App\Models\Eloquent\RecruitingEvaluationParameter;
use App\Models\Eloquent\RecruitingStep;
use App\Models\Eloquent\RecruitingStepSubStep;
use App\Models\Eloquent\RecruitingStepSubStepCheck;
use App\Services\AwsS3\StorageService;
use App\Services\Eloquent\EvaluationParameterService;
use App\Services\Eloquent\FileService;
use App\Services\Eloquent\RecruitingActivityService;
use App\Services\Eloquent\RecruitingEvaluationParameterService;
use App\Services\Eloquent\RecruitingStepSubStepCheckService;
use App\Services\Eloquent\RecruitingStepSubStepService;
use App\Services\MesajPaneli\MesajPaneliService;
use App\Traits\Response;

class RecruitingController extends Controller
{
    use Response;

    /**
     * @var $recruitingService
     */
    private $recruitingService;

    /**
     * @param IRecruitingService $recruitingService
     */
    public function __construct(IRecruitingService $recruitingService)
    {
        $this->recruitingService = $recruitingService;
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $getAllResponse = $this->recruitingService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword,
            $request->departmentIds,
            $request->stepIds
        );
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->recruitingService->getById(
            $request->id
        );
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param WizardRequest $request
     */
    public function wizard(WizardRequest $request)
    {
        $getByIdResponse = $this->recruitingService->wizard(
            $request->id
        );
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request,)
    {
        $createResponse = $this->recruitingService->create(
            $request->companyId,
            $request->departmentId,
            $request->name,
            $request->email,
            $request->phoneNumber,
            $request->identity,
            $request->birthDate,
            $request->obstacle
        );
        if ($createResponse->isSuccess()) {
            $storageService = new StorageService;
            $storageResponse = $storageService->store(
                $request->file('cv'),
                $request->filePath . $createResponse->getData()->id . '/'
            );
            if ($storageResponse->isSuccess()) {
                $fileService = new FileService;
                $fileResponse = $fileService->create(
                    $request->user()->id,
                    'App\\Models\\Eloquent\\User',
                    $createResponse->getData()->id,
                    'App\\Models\\Eloquent\\Recruiting',
                    null,
                    null,
                    $request->file('cv')->getClientOriginalName(),
                    $storageResponse->getData()
                );
                if ($fileResponse->isSuccess()) {
                    $updateCvResponse = $this->recruitingService->updateCv(
                        $createResponse->getData()->id,
                        $fileResponse->getData()->id
                    );
                    if ($updateCvResponse->isSuccess()) {
                        $recruitingSteps = RecruitingStep::all();
                        foreach ($recruitingSteps as $recruitingStep) {
                            $recruitingStepSubSteps = RecruitingStepSubStep::where('recruiting_step_id', $recruitingStep->id)->get();
                            foreach ($recruitingStepSubSteps as $recruitingStepSubStep) {
                                $recruitingStepSubStepCheck = new RecruitingStepSubStepCheck;
                                $recruitingStepSubStepCheck->recruiting_id = $createResponse->getData()->id;
                                $recruitingStepSubStepCheck->recruiting_step_id = $recruitingStep->id;
                                $recruitingStepSubStepCheck->recruiting_step_sub_step_id = $recruitingStepSubStep->id;
                                $recruitingStepSubStepCheck->user_id = $request->user()->id;
                                $recruitingStepSubStepCheck->save();
                            }
                        }
                        $evaluationParameterService = new EvaluationParameterService;
                        $evaluationParameters = $evaluationParameterService->getAll();
                        if ($evaluationParameters->isSuccess()) {
                            $recruitingEvaluationParameterService = new RecruitingEvaluationParameterService;
                            foreach ($evaluationParameters->getData() as $evaluationParameter) {
                                $recruitingEvaluationParameterService->create(
                                    $createResponse->getData()->id,
                                    $evaluationParameter->name
                                );
                            }
                            return $this->success(
                                $createResponse->getMessage(),
                                $createResponse->getData(),
                                $createResponse->getStatusCode()
                            );
                        } else {
                            return $this->error(
                                $evaluationParameters->getMessage(),
                                $evaluationParameters->getStatusCode()
                            );
                        }
                    } else {
                        return $this->error(
                            $updateCvResponse->getMessage(),
                            $updateCvResponse->getStatusCode()
                        );
                    }
                } else {
                    return $this->error(
                        $fileResponse->getMessage(),
                        $fileResponse->getStatusCode()
                    );
                }
            } else {
                return $this->error(
                    $storageResponse->getMessage(),
                    $storageResponse->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->recruitingService->update(
            $request->id,
            $request->companyId,
            $request->departmentId,
            $request->name,
            $request->email,
            $request->phoneNumber,
            $request->identity,
            $request->birthDate,
            $request->obstacle
        );
        if ($updateResponse->isSuccess()) {
            if ($request->hasFile('cv')) {
                $storageService = new StorageService;
                $storageResponse = $storageService->store(
                    $request->file('cv'),
                    $request->filePath . $updateResponse->getData()->id . '/'
                );
                if ($storageResponse->isSuccess()) {
                    $fileService = new FileService;
                    $fileResponse = $fileService->create(
                        $request->user()->id,
                        'App\\Models\\Eloquent\\User',
                        $updateResponse->getData()->id,
                        'App\\Models\\Eloquent\\Recruiting',
                        null,
                        null,
                        $request->file('cv')->getClientOriginalName(),
                        $storageResponse->getData()
                    );
                    if ($fileResponse->isSuccess()) {
                        $updateCvResponse = $this->recruitingService->updateCv(
                            $updateResponse->getData()->id,
                            $fileResponse->getData()->id
                        );
                        if ($updateCvResponse->isSuccess()) {
                            return $this->success(
                                $updateResponse->getMessage(),
                                $updateResponse->getData(),
                                $updateResponse->getStatusCode()
                            );
                        } else {
                            return $this->error(
                                $updateCvResponse->getMessage(),
                                $updateCvResponse->getStatusCode()
                            );
                        }
                    } else {
                        return $this->error(
                            $fileResponse->getMessage(),
                            $fileResponse->getStatusCode()
                        );
                    }
                } else {
                    return $this->error(
                        $storageResponse->getMessage(),
                        $storageResponse->getStatusCode()
                    );
                }
            } else {
                return $this->success(
                    $updateResponse->getMessage(),
                    $updateResponse->getData(),
                    $updateResponse->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $updateResponse->getMessage(),
                $updateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SendSmsRequest $request
     */
    public function sendSms(SendSmsRequest $request)
    {
        $recruiting = Recruiting::find($request->id);
        $mesajPaneliService = new MesajPaneliService;
        $sendSms = $mesajPaneliService->sendSms(
            [[
                'msg' => $request->message,
                'tel' => [clearPhoneNumber($recruiting->phone_number)]
            ]]
        );
        if ($sendSms->isSuccess()) {
            return $this->success(
                $sendSms->getMessage(),
                $sendSms->getData(),
                $sendSms->getStatusCode()
            );
        } else {
            return $this->error(
                $sendSms->getMessage(),
                $sendSms->getStatusCode()
            );
        }
    }

    /**
     * @param CancelRequest $request
     */
    public function cancel(CancelRequest $request)
    {
        $cancelResponse = $this->recruitingService->cancel(
            $request->id,
            $request->user()->id,
            $request->reason
        );
        if ($cancelResponse->isSuccess()) {
            return $this->success(
                $cancelResponse->getMessage(),
                $cancelResponse->getData(),
                $cancelResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $cancelResponse->getMessage(),
                $cancelResponse->getStatusCode()
            );
        }
    }

    /**
     * @param ReactivateRequest $request
     */
    public function reactivate(ReactivateRequest $request)
    {
        $reactivateResponse = $this->recruitingService->reactivate(
            $request->id
        );
        if ($reactivateResponse->isSuccess()) {
            RecruitingStepSubStepCheck::where('recruiting_id', $request->id)->delete();
            RecruitingEvaluationParameter::where('recruiting_id', $request->id)->delete();
            $recruitingSteps = RecruitingStep::all();
            foreach ($recruitingSteps as $recruitingStep) {
                $recruitingStepSubSteps = RecruitingStepSubStep::where('recruiting_step_id', $recruitingStep->id)->get();
                foreach ($recruitingStepSubSteps as $recruitingStepSubStep) {
                    $recruitingStepSubStepCheck = new RecruitingStepSubStepCheck;
                    $recruitingStepSubStepCheck->recruiting_id = $reactivateResponse->getData()->id;
                    $recruitingStepSubStepCheck->recruiting_step_id = $recruitingStep->id;
                    $recruitingStepSubStepCheck->recruiting_step_sub_step_id = $recruitingStepSubStep->id;
                    $recruitingStepSubStepCheck->user_id = $request->user()->id;
                    $recruitingStepSubStepCheck->save();
                }
            }
            $evaluationParameterService = new EvaluationParameterService;
            $evaluationParameters = $evaluationParameterService->getAll();
            if ($evaluationParameters->isSuccess()) {
                $recruitingEvaluationParameterService = new RecruitingEvaluationParameterService;
                foreach ($evaluationParameters->getData() as $evaluationParameter) {
                    $recruitingEvaluationParameterService->create(
                        $reactivateResponse->getData()->id,
                        $evaluationParameter->name
                    );
                }

                $recruitingActivityService = new RecruitingActivityService;
                $recruitingActivityService->create(
                    $reactivateResponse->getData()->id,
                    'Havuzda',
                    $request->user()->id,
                    'Yeniden Havuza Aktarıldı'
                );

                return $this->success(
                    $reactivateResponse->getMessage(),
                    $reactivateResponse->getData(),
                    $reactivateResponse->getStatusCode()
                );
            } else {
                return $this->error(
                    $evaluationParameters->getMessage(),
                    $evaluationParameters->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $reactivateResponse->getMessage(),
                $reactivateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetStepRequest $request
     */
    public function setStep(SetStepRequest $request)
    {
        $recruiting = Recruiting::find($request->id);
        $recruiting->step_id = $request->stepId;
        $recruiting->save();

        RecruitingStepSubStepCheck::where('recruiting_id', $request->id)->where('recruiting_step_id', '>=', $request->stepId)->delete();
        $recruitingSteps = RecruitingStep::where('id', '>=', $request->stepId)->get();
        foreach ($recruitingSteps as $recruitingStep) {
            $recruitingStepSubSteps = RecruitingStepSubStep::where('recruiting_step_id', $recruitingStep->id)->get();
            foreach ($recruitingStepSubSteps as $recruitingStepSubStep) {
                $recruitingStepSubStepCheck = new RecruitingStepSubStepCheck;
                $recruitingStepSubStepCheck->recruiting_id = $request->id;
                $recruitingStepSubStepCheck->recruiting_step_id = $recruitingStep->id;
                $recruitingStepSubStepCheck->recruiting_step_sub_step_id = $recruitingStepSubStep->id;
                $recruitingStepSubStepCheck->user_id = $request->user()->id;
                $recruitingStepSubStepCheck->save();
            }
        }

        return $this->success(
            'Step set',
            []
        );
    }

    /**
     * @param NextStepRequest $request
     */
    public function nextStep(NextStepRequest $request)
    {
        $recruiting = Recruiting::find($request->id);
        if ($recruiting->step_id < 8) {
            $nextStepId = $recruiting->step_id + 1;
            $nextStep = RecruitingStep::find($nextStepId);

            $recruiting->step_id = $nextStepId;
            $recruiting->save();

            $recruitingActivityService = new RecruitingActivityService;
            $recruitingActivityService->create(
                $request->id,
                $nextStep->name,
                $request->user()->id,
                $request->description
            );

            return $this->success(
                'Next step',
                []
            );
        } else {
            return $this->error(
                'Step is not valid',
                400
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->recruitingService->delete(
            $request->id
        );
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
            );
        }
    }
}
