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
     * @return array[]
     * @throws Exception
     */
    public function execute(StorePaymentDTO $dto)
    {
        DB::beginTransaction();
        try {
            $data = [];
            $data_current = [];
            for ($i=0; $i<count($dto->getServiceId()); $i++)
            {
                $current_payment = Payment::query()
                    ->where('user_id', '=', $dto->getUserId())
                    ->where('patient_id', '=', $dto->getPatientId())
                    ->where('service_id', '=', $dto->getServiceId()[$i])
                    ->first();
                $current_payment_history = PaymentHistory::query()
                    ->where('user_id', '=', $dto->getUserId())
                    ->where('patient_id', '=', $dto->getPatientId())
                    ->where('service_id', '=', $dto->getServiceId()[$i])
                    ->first();

                if ($current_payment == null && $current_payment_history == null) {
                    $payment = new Payment();
                    $payment_history = new PaymentHistory();

                    $payment->user_id = $dto->getUserId();
                    $payment->patient_id = $dto->getPatientId();
                    $payment->service_id = $dto->getServiceId()[$i];
                    $payment->service_price = $dto->getServicePrice();
                    $payment->difference_price = $dto->getDifferencePrice();
                    $payment->pay_patient = $dto->getPayPatient();
                    $payment->return_patient_pay = $dto->getReturnPatientPay();
                    $payment->status = $dto->getStatus();
                    $payment->save();

                    $payment_history->user_id = $dto->getUserId();
                    $payment_history->patient_id = $dto->getPatientId();
                    $payment_history->service_id = $dto->getServiceId()[$i];
                    $payment_history->service_price = $dto->getServicePrice();
                    $payment_history->difference_price = $dto->getDifferencePrice();
                    $payment_history->pay_patient = $dto->getPayPatient();
                    $payment_history->return_patient_pay = $dto->getReturnPatientPay();
                    $payment_history->status = $dto->getStatus();
                    $payment_history->save();

                    DB::commit();
                    $data[$i] = $payment;
                } elseif($current_payment != null && $current_payment_history != null) {
                    $current_payment->user_id = $dto->getUserId();
                    $current_payment->patient_id = $dto->getPatientId();
                    $current_payment->service_id = $dto->getServiceId()[$i];
                    $current_payment->service_price = $dto->getServicePrice();
                    $current_payment->difference_price = $dto->getDifferencePrice();
                    $current_payment->pay_patient = $dto->getPayPatient();
                    $current_payment->return_patient_pay = $dto->getReturnPatientPay();
                    $current_payment->status = $dto->getStatus();
                    $current_payment->update();

                    $current_payment_history->user_id = $dto->getUserId();
                    $current_payment_history->patient_id = $dto->getPatientId();
                    $current_payment_history->service_id = $dto->getServiceId()[$i];
                    $current_payment_history->service_price = $dto->getServicePrice();
                    $current_payment_history->difference_price = $dto->getDifferencePrice();
                    $current_payment_history->pay_patient = $dto->getPayPatient();
                    $current_payment_history->return_patient_pay = $dto->getReturnPatientPay();
                    $current_payment_history->status = $dto->getStatus();
                    $current_payment_history->update();

                    DB::commit();
                    $data_current[$i] = $current_payment;
                }
            }
            return [
                'new' => $data,
                'current' => $data_current
            ];
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }



//    /**
//     * @param StorePaymentDTO $dto
//     * @return Builder|Model|object
//     * @throws Exception
//     */
//    public function execute(StorePaymentDTO $dto)
//    {
//        DB::beginTransaction();
//        try {
//            $current_payment = Payment::query()
//                ->where('user_id', '=', $dto->getUserId())
//                ->where('patient_id', '=', $dto->getPatientId())
//                ->first();
//            $current_payment_history = PaymentHistory::query()
//                ->where('user_id', '=', $dto->getUserId())
//                ->where('patient_id', '=', $dto->getPatientId())
//                ->first();
//
//            if ($current_payment == null && $current_payment_history == null) {
//                $payment = new Payment();
//                $payment_history = new PaymentHistory();
//                $this->extracted($dto, $payment, $payment_history);
//                $payment->save();
//                $payment_history->save();
//                DB::commit();
//                return $payment;
//            } else {
//                $this->extracted($dto, $current_payment, $current_payment_history);
//                $current_payment->update();
//                $current_payment_history->update();
//                DB::commit();
//                return $current_payment;
//            }
//
//        } catch (Exception $exception) {
//            DB::rollBack();
//            throw $exception;
//        }
//    }
//
//    /**
//     * @param StorePaymentDTO $dto
//     * @param Payment $payment
//     * @param PaymentHistory $payment_history
//     * @return void
//     */
//    public function extracted(StorePaymentDTO $dto, Payment $payment, PaymentHistory $payment_history): void
//    {
//        $payment->user_id = $dto->getUserId();
//        $payment->patient_id = $dto->getPatientId();
//        $payment->service_id = $dto->getServiceId();
//        $payment->service_price = $dto->getServicePrice();
//        $payment->difference_price = $dto->getDifferencePrice();
//        $payment->pay_patient = $dto->getPayPatient();
//        $payment->return_patient_pay = $dto->getReturnPatientPay();
//        $payment->status = $dto->getStatus();
//
//        $payment_history->user_id = $dto->getUserId();
//        $payment_history->patient_id = $dto->getPatientId();
//        $payment_history->service_id = $dto->getServiceId();
//        $payment_history->service_price = $dto->getServicePrice();
//        $payment_history->difference_price = $dto->getDifferencePrice();
//        $payment_history->pay_patient = $dto->getPayPatient();
//        $payment_history->return_patient_pay = $dto->getReturnPatientPay();
//        $payment_history->status = $dto->getStatus();
//    }
}
