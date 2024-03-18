<?php

namespace App\Http\Controllers\MKB;

use App\Domain\MKB\Models\MKB;
use App\Filters\MKBFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Filters\MKBFilterRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MKBController extends Controller
{
    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function index(MKBFilterRequest $request)
    {
        $filter = app()->make(MKBFilter::class, ['queryParams' => array_filter($request->validated())]);
        return response()
            ->json([
                'status' => true,
                'data' => MKB::query()
                    ->Filter($filter)
                    ->paginate()
            ]);
    }
}
