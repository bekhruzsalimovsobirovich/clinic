<?php

namespace App\Http\Controllers\Admissions;

use App\Domain\Admissions\Actions\StoreAdmissionAction;
use App\Domain\Admissions\DTO\StoreAdmissionDTO;
use App\Domain\Admissions\Models\Admission;
use App\Domain\Admissions\Repositories\AdmissionRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdmissionController extends Controller
{
    /**
     * @var mixed|AdmissionRepository
     */
    public mixed $admissions;

    /**
     * @param AdmissionRepository $admissionRepository
     */
    public function __construct(AdmissionRepository $admissionRepository)
    {
        $this->admissions = $admissionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->admissions->paginate()
            ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function userPatient(Request $request)
    {
        $admission = new Admission();
        $admission->user_id = $request->user_id;
        $admission->patient_id = $request->patient_id;
        $admission->request_id = $request->request_id;
        $admission->status = $request->status;
        $admission->save();

        return response()
            ->json([
                'status' => 'true',
                'message' => 'Bemor vrachga biriktirildi',
                'data' => $admission
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreAdmissionAction $action)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'patient_id' => 'required',
                'admissions' => 'nullable',
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreAdmissionDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Admission created successfully.',
                    'data' => $response
                ]);
        } catch (Exception $exception) {
            return response()
                ->json([
                    'status' => false,
                    'message' => $exception->getMessage()
                ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * @return JsonResponse
     */
    public function getLatestRequestId()
    {
        return response()
            ->json(
                Admission::query()
                ->select('request_id')
                ->orderByDesc('request_id')
                ->first()
            );
    }
}
