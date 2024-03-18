<?php

namespace App\Http\Controllers\MKB;

use App\Domain\MKB\Models\MKB;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MKBController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => MKB::query()->paginate()
            ]);
    }
}
