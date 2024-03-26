<?php

namespace App\Http\Controllers\Summaries;

use App\Domain\Summaries\Actions\StoreSummaryAction;
use App\Domain\Summaries\DTO\StoreSummaryDTO;
use App\Domain\Summaries\Repositories\SummaryRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SummaryController extends Controller
{
    /**
     * @var mixed|SummaryRepository
     */
    public mixed $summaries;

    /**
     * @param SummaryRepository $summaryRepository
     */
    public function __construct(SummaryRepository $summaryRepository)
    {
        $this->summaries = $summaryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->summaries->paginte()
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
                'data' => $this->summaries->getAll()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreSummaryAction $action)
    {
        try {
            $request->validate([
                'patient_id' => 'required',
                'body' => 'required',
                'files' => 'nullable',
                'mkb' => 'nullable'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreSummaryDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Summary created successfully.',
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
