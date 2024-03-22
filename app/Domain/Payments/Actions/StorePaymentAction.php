<?php

namespace App\Domain\Payments\Actions;

use App\Domain\Payments\DTO\StorePaymentDTO;
use App\Domain\Payments\Models\Payment;
use App\Domain\Payments\Models\PaymentHistory;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StorePaymentAction
{
    /**
     * @param StorePaymentDTO $dto
     * @return Payment
     * @throws Exception
     */
    public function execute(StorePaymentDTO $dto)
    {
        DB::beginTransaction();
        try {
            $payment = new Payment();
            $payment_history = new PaymentHistory();

            $payment->patient_id = $dto->getPatientId();
            $payment->status = $dto->getStatus();
            $payment->return_status = $dto->getReturnStatus();
            $payment->pays = $dto->getPays();
            $payment->save();

            $payment_history->patient_id = $dto->getPatientId();
            $payment_history->status = $dto->getStatus();
            $payment_history->return_status = $dto->getReturnStatus();
            $payment_history->pays = $dto->getPays();
            $payment_history->save();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return $payment;
    }
}
