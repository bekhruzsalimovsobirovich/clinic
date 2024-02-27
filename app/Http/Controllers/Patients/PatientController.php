<?php

namespace App\Http\Controllers\Patients;

use App\Domain\Patients\Actions\StorePatientAction;
use App\Domain\Patients\Actions\UpdatePatientAction;
use App\Domain\Patients\DTO\StorePatientDTO;
use App\Domain\Patients\DTO\UpdatePatientDTO;
use App\Domain\Patients\Models\Patient;
use App\Domain\Patients\Repositories\PatientRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class PatientController extends Controller
{
    /**
     * @var mixed|PatientRepository
     */
    public mixed $patients;

    /**
     * @param PatientRepository $patientRepository
     */
    public function __construct(PatientRepository $patientRepository)
    {
        $this->patients = $patientRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->patients->getPaginate()
            ]);
    }

    /**
     * @return JsonResponse
     */
    public function getAll()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->patients->getAll()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StorePatientAction $action)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'agent_id' => 'required',
                'full_name' => 'required',
                'workplace' => 'nullable|string',
                'birthday' => 'required',
                'province_city' => 'required',
                'address' => 'required|string',
                'job' => 'nullable|string',
                'phone' => 'nullable|string',
                'description' => 'nullable|string',
                'avatar' => 'nullable',
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StorePatientDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Patient created successfully.',
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
    public function update(Request $request, Patient $patient, UpdatePatientAction $action)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'agent_id' => 'required',
                'full_name' => 'required',
                'workplace' => 'nullable|string',
                'birthday' => 'required',
                'province_city' => 'required',
                'address' => 'required|string',
                'job' => 'nullable|string',
                'phone' => 'nullable|string',
                'description' => 'nullable|string',
                'avatar' => 'nullable',
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $request->merge([
                'patient' => $patient
            ]);
            $dto = UpdatePatientDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Patient updated successfully.',
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
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        if (File::exists(public_path('images/patients/' . $patient->avatar))) {
            File::delete(public_path('images/patients/' . $patient->avatar));
        }

        return response()
            ->json([
                'status' => true,
                'message' => 'Patient deleted successfully'
            ]);
    }
}
