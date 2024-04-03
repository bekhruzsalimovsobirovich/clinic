<?php

namespace App\Http\Controllers\Admissions;

use App\Domain\Admissions\Actions\StoreAdmissionAction;
use App\Domain\Admissions\DTO\StoreAdmissionDTO;
use App\Domain\Admissions\Repositories\AdmissionRepository;
use App\Http\Controllers\Controller;
use Exception;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreAdmissionAction $action)
    {
        try {
            $request->validate([
                'patient_id' => 'required',
                'status' => 'required',
                'admissions' => 'required',
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
}
