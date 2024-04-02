<?php

namespace App\Http\Controllers\UserPatients;

use App\Domain\UserPatients\Actions\StoreUserPatientAction;
use App\Domain\UserPatients\DTO\StoreUserPatientDTO;
use App\Domain\UserPatients\Repositories\UserPatientRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserPatientController extends Controller
{
    /**
     * @var mixed|UserPatientRepository
     */
    public mixed $user_patients;

    /**
     * @param UserPatientRepository $userPatientRepository
     */
    public function __construct(UserPatientRepository $userPatientRepository)
    {
        $this->user_patients = $userPatientRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data'=>$this->user_patients->paginate()
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
                'data'=>$this->user_patients->getAll()
            ]);
    }

    /**
     * @param $user_id
     * @return JsonResponse
     */
    public function getUserIDForPatientNavbat($user_id): JsonResponse
    {
        return response()
            ->json([
                'status' => true,
                'data'=>$this->user_patients->getUserIDForPatientNavbat($user_id)
            ]);
    }

    public function paginateNavbat()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->user_patients->paginateNavbat()
            ]);
    }

    public function paginateQaytaNavbat()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->user_patients->paginateQaytaNavbat()
            ]);
    }

    /**
     * @param $user_id
     * @return JsonResponse
     */
    public function getUserIDForPatientQaytaNavbat($user_id): JsonResponse
    {
        return response()
            ->json([
                'status' => true,
                'data'=>$this->user_patients->getUserIDForPatientQaytaNavbat($user_id)
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreUserPatientAction $action)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'patient_id' => 'required',
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreUserPatientDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'User patient created successfully.',
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
