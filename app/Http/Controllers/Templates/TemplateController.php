<?php

namespace App\Http\Controllers\Templates;

use App\Domain\Templates\Actions\StoreTemplateAction;
use App\Domain\Templates\DTO\StoreTemplateDTO;
use App\Domain\Templates\Models\Template;
use App\Domain\Templates\Repositories\TemplateRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TemplateController extends Controller
{
    /**
     * @var mixed|TemplateRepository
     */
    public mixed $templates;

    /**
     * @param TemplateRepository $templateRepository
     */
    public function __construct(TemplateRepository $templateRepository)
    {
        $this->templates = $templateRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->templates->getAll()
            ]);
    }

    public function showUserTemplate($user_id)
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->templates->showUserTemplate($user_id)
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreTemplateAction $action)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'patient_id' => 'required',
                'body' => 'required'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreTemplateDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Template created successfully.',
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
    public function show(Template $template)
    {

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
