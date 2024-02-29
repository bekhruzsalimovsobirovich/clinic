<?php

namespace App\Http\Controllers\Illnesses;

use App\Domain\Illnesses\Actions\StoreIllnessAction;
use App\Domain\Illnesses\Actions\UpdateIllnessAction;
use App\Domain\Illnesses\DTO\StoreIllnessDTO;
use App\Domain\Illnesses\DTO\UpdateIllnessDTO;
use App\Domain\Illnesses\Models\Illness;
use App\Domain\Illnesses\Repositories\IllnessRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IllnessController extends Controller
{
    /**
     * @var mixed|IllnessRepository
     */
    public mixed $illnesses;

    /**
     * @param IllnessRepository $illnessRepository
     */
    public function __construct(IllnessRepository $illnessRepository)
    {
        $this->illnesses = $illnessRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->illnesses->getPaginate()
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
                'data' => $this->illnesses->getAll()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreIllnessAction $action)
    {
        try {
            $request->validate([
                'title' => 'required',
                'code' => 'required'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreIllnessDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Illness created successfully.',
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
    public function update(Request $request, Illness $illness, UpdateIllnessAction $action)
    {
        try {
            $request->validate([
                'title' => 'required',
                'code' => 'required'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $request->merge([
                'illness' => $illness
            ]);
            $dto = UpdateIllnessDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Illness update successfully.',
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
    public function destroy(Illness $illness)
    {
        $illness->delete();

        return response()
            ->json([
                'status' => true,
                'message' => 'Illness deleted successfully.'
            ]);
    }
}
