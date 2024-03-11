<?php

namespace App\Http\Controllers\Services;

use App\Domain\Services\Actions\StoreServiceAction;
use App\Domain\Services\Actions\UpdateServiceAction;
use App\Domain\Services\DTO\StoreServiceDTO;
use App\Domain\Services\DTO\UpdateServiceDTO;
use App\Domain\Services\Models\Service;
use App\Domain\Services\Repositories\ServiceRepository;
use App\Filters\ServiceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Filters\ServiceFilterRequest;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ServicesController extends Controller
{
    /**
     * @var mixed|ServiceRepository
     */
    public mixed $services;

    /**
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->services = $serviceRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->services->getPaginate()
            ]);
    }

    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function getAll(ServiceFilterRequest $request)
    {
        $filter = app()->make(ServiceFilter::class, ['queryParams' => array_filter($request->validated())]);
        return response()
            ->json([
                'status' => true,
                'data' => $this->services->getAll($filter)
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreServiceAction $action)
    {
        try {
            $request->validate([
                'title' => 'required|unique:services,title',
                'price' => 'required'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreServiceDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Service created successfully.',
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
    public function update(Request $request, Service $service, UpdateServiceAction $action)
    {
        try {
            $request->validate([
                'title' => 'required',
                'price' => 'required'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $request->merge([
                'service' => $service
            ]);
            $dto = UpdateServiceDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Service updated successfully.',
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
    public function destroy(Service $service)
    {
        $service->delete();
        return response()
            ->json([
                'status' => true,
                'message' => 'Service deleted successfully'
            ]);
    }
}
