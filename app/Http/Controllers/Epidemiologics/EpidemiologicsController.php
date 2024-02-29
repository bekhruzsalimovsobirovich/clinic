<?php

namespace App\Http\Controllers\Epidemiologics;

use App\Domain\Epidemiologics\Actions\StoreEpidemiologicAction;
use App\Domain\Epidemiologics\Actions\UpdateEpidemiologicAction;
use App\Domain\Epidemiologics\DTO\StoreEpidemiologicDTO;
use App\Domain\Epidemiologics\DTO\UpdateEpidemiologicDTO;
use App\Domain\Epidemiologics\Models\Epidemiologic;
use App\Domain\Epidemiologics\Repositories\EpidemiologicRepository;
use App\Domain\Illnesses\Repositories\IllnessRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EpidemiologicsController extends Controller
{
    /**
     * @var mixed|EpidemiologicRepository
     */
    public mixed $epidemiologics;

    /**
     * @param EpidemiologicRepository $epidemiologicRepository
     */
    public function __construct(EpidemiologicRepository $epidemiologicRepository)
    {
        $this->epidemiologics = $epidemiologicRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->epidemiologics->getPaginate()
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
                'data' => $this->epidemiologics->getAll()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreEpidemiologicAction $action)
    {
        try {
            $request->validate([
                'title' => 'required'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreEpidemiologicDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Epidemiologic created successfully.',
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
    public function update(Request $request, Epidemiologic $epidemiologic, UpdateEpidemiologicAction $action)
    {
        try {
            $request->validate([
                'title' => 'required'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $request->merge([
                'epidemiologic' => $epidemiologic
            ]);
            $dto = UpdateEpidemiologicDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Epidemiologic update successfully.',
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
    public function destroy(Epidemiologic $epidemiologic)
    {
        $epidemiologic->delete();

        return response()
            ->json([
                'status' => true,
                'message' => 'Epidemiologic deleted successfully.'
            ]);
    }
}
