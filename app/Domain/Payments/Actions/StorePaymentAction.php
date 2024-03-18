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
     * @return array[]
     * @throws Exception
     */
    public function execute(StorePaymentDTO $dto)
    {
        DB::beginTransaction();
        try {
            $data = [];
            for ($i = 0; $i < count($dto->getServiceId()); $i++) {
                $payment = new Payment();
                $payment_history = new PaymentHistory();

                $payment->patient_id = $dto->getPatientId();
                $payment->service_id = $dto->getServiceId()[$i];
                $payment->status = $dto->getStatus();
                $payment->return_status = $dto->getReturnStatus();
                $payment->pay_patient = $dto->getPayPatient();
                $payment->return_pay_patient = $dto->getReturnPayPatient();
                $payment->service_price = $dto->getServicePrice();
                $payment->difference_price = $dto->getDifferencePrice();
                $payment->save();

                $payment_history->patient_id = $dto->getPatientId();
                $payment_history->service_id = $dto->getServiceId()[$i];
                $payment_history->status = $dto->getStatus();
                $payment_history->return_status = $dto->getReturnStatus();
                $payment_history->pay_patient = $dto->getPayPatient();
                $payment_history->return_pay_patient = $dto->getReturnPayPatient();
                $payment_history->service_price = $dto->getServicePrice();
                $payment_history->difference_price = $dto->getDifferencePrice();
                $payment_history->save();

                DB::commit();
                $data[$i] = $payment;
            }
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return $data;
    }
}
