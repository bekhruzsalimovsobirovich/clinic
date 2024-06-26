<?php

namespace App\Http\Controllers\Patients;

use App\Domain\Admissions\Models\Admission;
use App\Domain\Patients\Actions\StorePatientAction;
use App\Domain\Patients\Actions\UpdatePatientAction;
use App\Domain\Patients\DTO\StorePatientDTO;
use App\Domain\Patients\DTO\UpdatePatientDTO;
use App\Domain\Patients\Models\Patient;
use App\Domain\Patients\Repositories\PatientRepository;
use App\Filters\PatientAdmissionStatusFilter;
use App\Filters\PatientFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Filters\PatientAdmissionStatusFilterRequest;
use App\Http\Requests\Filters\PatientFilterRequest;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PatientController extends Controller
{
    /**
     * @var mixed|PatientRepository
     */
    public mixed $patients;

    /**
     * @var mixed
     */
    public mixed $filters;

    /**
     * @param PatientRepository $patientRepository
     * @param PatientFilterRequest $request
     * @throws BindingResolutionException
     */
    public function __construct(PatientRepository $patientRepository, PatientFilterRequest $request)
    {
        $this->patients = $patientRepository;
        $this->filters = app()->make(PatientFilter::class, ['queryParams' => array_filter($request->validated())]);
    }

    /**
     * @return JsonResponse
     */
    public function searchPatient(): JsonResponse
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->patients->searchPatient($this->filters)
            ]);
    }

    public function paginateTypeAdmissionStatus(PatientAdmissionStatusFilterRequest $request)
    {
        $filters = app()->make(PatientAdmissionStatusFilter::class, ['queryParams' => array_filter($request->validated())]);

        return response()
            ->json([
                'status' => true,
                'data' => $this->patients->paginateTypeAdmissionStatus($filters)
            ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->patients->getPaginate($this->filters)
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
                'code' => 'required|string',
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
    public function show(Patient $patient)
    {
        return response()
            ->json([
                'status' => true,
                'data' => $patient
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient, UpdatePatientAction $action)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'code' => 'nullable',
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
        if (File::delete('storage/files/patients/images/' . $patient->avatar)) {
            File::delete('storage/files/patients/images/' . $patient->avatar);
        }

        $patient->delete();

        return response()
            ->json([
                'status' => true,
                'message' => 'Patient deleted successfully'
            ]);
    }

//    patient epidemiologic
    public function attach(Request $request)
    {
        $patient = Patient::find($request->patient_id);
        $patient->epidemiologics()->sync($request->epidemiologic_id);

        return response()
            ->json([
                'status' => true,
                'data' => $patient
            ]);
    }

//qabulni yakunlash
    public function endQabul(Request $request)
    {
        $admission = Admission::query()
            ->where('id','=',$request->admission_id)
            ->where('patient_id','=',$request->patient_id)
            ->first();

        $patient = Patient::query()->find($request->patient_id);

        $admission->uuid = Str::uuid();
        $patient->status = 1;
        $patient->update();
        $admission->update();

        return response()
            ->json([
                'status' => true,
                'message' => 'Ushbu ' . $patient->full_name . ' bemor uchun qabul yakunlandi.'
            ]);
    }

    public function paginateEndPatient()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->patients->paginateEndPatient($this->filters)
            ]);
    }
}
