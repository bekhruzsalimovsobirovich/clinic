<?php

namespace App\Http\Controllers\Files;

use App\Domain\Files\Actions\StoreFileAction;
use App\Domain\Files\DTO\StoreFileDTO;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FileController extends Controller
{
    public function store(Request $request, StoreFileAction $action)
    {
        try {
            $request->validate([
                'title.*' => 'mimes:jpeg,png,jpg,svg,pdf,doc,docx,xlsx,xls', 'max:2048'
            ]);
        } catch (ValidationException $validationException) {
            return response()
                ->json([
                    'status' => false,
                    'message' => $validationException->getMessage(),
                    'data' => $validationException->validator->errors()
                ]);
        }

        try {
            $dto = StoreFileDTO::fromArray($request->all());
            $response = $action->execute($dto);

            return response()
                ->json([
                    'status' => true,
                    'message' => 'Files saved successfully.',
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
}
