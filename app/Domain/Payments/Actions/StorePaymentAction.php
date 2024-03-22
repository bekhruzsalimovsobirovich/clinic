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
            $current_payment = Payment::query()
                ->where('patient_id', '=', $dto->getPatientId())
                ->first();
            $current_payment_history = PaymentHistory::query()
                ->where('patient_id', '=', $dto->getPatientId())
                ->first();

            if ($current_payment == null) {
                $payment = new Payment();
                $payment_history = new PaymentHistory();

                $payment->patient_id = $dto->getPatientId();
                $payment->status = $dto->getStatus();
                $payment->return_status = $dto->getReturnStatus();
                $payment->pays = $dto->getPays();
                $payment->services = $dto->getServices();
                $payment->save();

                $payment_history->patient_id = $dto->getPatientId();
                $payment_history->status = $dto->getStatus();
                $payment_history->return_status = $dto->getReturnStatus();
                $payment_history->pays = $dto->getPays();
                $payment_history->services = $dto->getServices();
                $payment_history->save();
                DB::commit();
                return $payment;
            } else {
                $new_pays = $dto->getPays();

                if($current_payment->pays != null){
                    $mergeData = array_merge($current_payment->pays, $new_pays);
                }else{
                    $mergeData = $dto->getPays();
                }
                $current_payment->pays = $mergeData;
                $current_payment->update();

                if($current_payment_history->pays != null){
                    $mergeDataHistory = array_merge($current_payment_history->pays, $new_pays);
                }else{
                    $mergeDataHistory = $dto->getPays();
                }
                $current_payment_history->pays = $mergeDataHistory;
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
