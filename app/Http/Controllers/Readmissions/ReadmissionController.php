<?php

namespace App\Http\Controllers\Readmissions;

use App\Domain\Readmissions\Actions\StoreReadmissionAction;
use App\Domain\Readmissions\DTO\StoreReadmissonDTO;
use App\Domain\Readmissions\Repositories\ReadmissionRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReadmissionController extends Controller
{
    /**
     * @var mixed|ReadmissionRepository
     */
    public mixed $readmissions;

    /**
     * @param ReadmissionRepository $readmissionRepository
     */
    public function __construct(ReadmissionRepository $readmissionRepository)
    {
        $this->readmissions = $readmissionRepository;
    }

//    ----------------------------------------------------- QAYTA NAVBAT -----------------------------------------------

    /**
     * Display a listing of the resource.
     */
    public function indexQaytaNavbat()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->readmissions->paginateQaytaNavbat()
            ]);
    }

    /**
     * @return JsonResponse
     */
    public function getAllQaytaNavbat()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->readmissions->getAllQaytaNavbat()
            ]);
    }
//    ----------------------------------------------------- QAYTA NAVBAT -----------------------------------------------


//    ----------------------------------------------------- DISPONSER RO'YXATI -----------------------------------------
    /**
     * Display a listing of the resource.
     */
    public function indexDisponser()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->readmissions->paginateDisponser()
            ]);
    }

    /**
     * @return JsonResponse
     */
    public function getAllDisponser()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->readmissions->getAllDisponser()
            ]);
    }
//    ----------------------------------------------------- DISPONSER RO'YXATI -----------------------------------------


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreReadmissionAction $action)
    {
        try {
            $request->validate([
                'patient_id' => 'required',
                'date' => 'required|date',
                'status' => 'required',
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreReadmissonDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Readmission created successfully.',
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
}
