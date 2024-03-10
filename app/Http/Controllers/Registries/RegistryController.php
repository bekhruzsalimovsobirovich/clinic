<?php

namespace App\Http\Controllers\Registries;

use App\Domain\Registries\Actions\StoreRegistryAction;
use App\Domain\Registries\DTO\StoreRegistryDTO;
use App\Domain\Registries\Repositories\RegistryRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegistryController extends Controller
{
    /**
     * @var mixed|RegistryRepository
     */
    public mixed $registries;

    /**
     * @param RegistryRepository $registryRepository
     */
    public function __construct(RegistryRepository $registryRepository)
    {
        $this->registries = $registryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->registries->paginate()
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
                'data' => $this->registries->getAll()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreRegistryAction $action)
    {
        try {
            $request->validate([
                'patient_id' => 'required',
                'data' => 'required|array',
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreRegistryDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Registry created successfully.',
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
