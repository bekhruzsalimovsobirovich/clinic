<?php

namespace App\Http\Controllers\Agents;

use App\Domain\Agents\Actions\StoreAgentAction;
use App\Domain\Agents\DTO\StoreAgentDTO;
use App\Domain\Agents\Repositories\AgentRepository;
use App\Domain\Agents\Requests\StoreAgentRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AgentController extends Controller
{
    /**
     * @var mixed|AgentRepository
     */
    public mixed $agents;

    /**
     * @param AgentRepository $agentRepository
     */
    public function __construct(AgentRepository $agentRepository)
    {
        $this->agents = $agentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->agents->getPaginate()
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
                'data' => $this->agents->getAll()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreAgentAction $action)
    {
        try {
            $request->validate([
                'full_name' => 'required',
                'phone' => 'required'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreAgentDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Agent created successfully.',
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
