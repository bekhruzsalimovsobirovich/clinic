<?php

namespace App\Http\Controllers\Payments;

use App\Domain\Payments\Actions\StorePaymentAction;
use App\Domain\Payments\DTO\StorePaymentDTO;
use App\Domain\Payments\Repositories\PaymentRepository;
use App\Filters\PaymentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Filters\PaymentFilterRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    /**
     * @var mixed|PaymentRepository
     */
    public mixed $payments;

    /**
     * @param PaymentRepository $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->payments = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PaymentFilterRequest $request)
    {
//        $filter = app()->make(PaymentFilter::class, ['queryParams' => array_filter($request->validated())]);
//        return response()
//            ->json([
//                'status' => true,
//                'data' => $this->payments->paginate($filter)
//            ]);
    }

    public function navbat(PaymentFilterRequest $request)
    {
        $filter = app()->make(PaymentFilter::class, ['queryParams' => array_filter($request->validated())]);
        return response()
            ->json([
                'status' => true,
                'data' => $this->payments->navbat($filter)
            ]);
    }

    /**
     * @return JsonResponse
     * qarzdorlar ro'yxati
     */
    public function debtors()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->payments->debtors()
            ]);
    }

    public function qaytaNavbat(PaymentFilterRequest $request)
    {
        $filter = app()->make(PaymentFilter::class, ['queryParams' => array_filter($request->validated())]);
        return response()
            ->json([
                'status' => true,
                'data' => $this->payments->qaytaNavbat($filter)
            ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->payments->getAll()
            ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function getUserIDForPayment($user_id)
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->payments->getUserIDForPayment($user_id)
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StorePaymentAction $action)
    {
        try {
            $request->validate([
                'patient_id' => 'required'
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StorePaymentDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Payment created successfully.',
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
