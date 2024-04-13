<?php

namespace App\Domain\Payments\Actions;

use App\Domain\Payments\DTO\StorePaymentDTO;
use App\Domain\Payments\Models\Payment;
use App\Domain\Payments\Models\PaymentHistory;
use Exception;
use Illuminate\Support\Facades\DB;

class StorePaymentAction
{
    /**
     * @param StorePaymentDTO $dto
     * @return Payment
     * @throws Exception
     */
    public function execute(StorePaymentDTO $dto): Payment
    {
        DB::beginTransaction();
        try {
            $payment = new Payment();
            $payment_history = new PaymentHistory();

            $current_payment = Payment::query()
                ->where('patient_id', $dto->getPatientId())
                ->where('admission_id', $dto->getAdmissionId())
                ->first();

            $current_payment_history = PaymentHistory::query()
                ->where('patient_id', $dto->getPatientId())
                ->where('admission_id', $dto->getAdmissionId())
                ->first();

            if ($current_payment == null) {
                $payment->patient_id = $dto->getPatientId();
                $payment->admission_id = $dto->getAdmissionId();
                $payment->status = $dto->getStatus();
                $payment->pays = $dto->getPays();
                $payment->save();

                $payment_history->patient_id = $dto->getPatientId();
                $payment_history->admission_id = $dto->getAdmissionId();
                $payment_history->status = $dto->getStatus();
                $payment_history->pays = $dto->getPays();
                $payment_history->save();
                DB::commit();
                return $payment;
            } else {
                if ($current_payment->pays != null) {
                    $current_payment->pays = array_merge($current_payment->pays, $dto->getPays());
                    $current_payment_history->pays = array_merge($current_payment_history->pays, $dto->getPays());
                } else {
                    $current_payment->pays = $dto->getPays();
                    $current_payment_history->pays = $dto->getPays();
                }
                $current_payment->status = $dto->getStatus();
                $current_payment_history->status = $dto->getStatus();
                $current_payment->update();
                $current_payment_history->update();
                DB::commit();
                return $current_payment;
            }


        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
