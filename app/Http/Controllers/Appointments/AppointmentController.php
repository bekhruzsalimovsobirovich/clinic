<?php

namespace App\Http\Controllers\Appointments;

use App\Domain\Appointments\Actions\StoreAppointmentAction;
use App\Domain\Appointments\Actions\UpdateAppointmentAction;
use App\Domain\Appointments\DTO\StoreAppointmentDTO;
use App\Domain\Appointments\DTO\UpdateAppointmentDTO;
use App\Domain\Appointments\Models\Appointment;
use App\Domain\Appointments\Repositories\AppointmentRepository;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    /**
     * @var mixed|AppointmentRepository
     */
    public mixed $appointments;

    /**
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointments = $appointmentRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()
            ->json([
                'status' => true,
                'data' => $this->appointments->getAll()
            ]);
    }

    /**
     * @param Request $request
     * @param StoreAppointmentAction $action
     * @return JsonResponse
     */
    public function store(Request $request,StoreAppointmentAction $action)
    {
        try {
            $request->validate([
                'full_name' => 'required',
                'phone' => 'required',
                'date' => 'required',
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $dto = StoreAppointmentDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Appointment created successfully.',
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
     * @param Request $request
     * @param Appointment $appointment
     * @param UpdateAppointmentAction $action
     * @return JsonResponse
     */
    public function update(Request $request,Appointment $appointment,UpdateAppointmentAction $action)
    {
        try {
            $request->validate([
                'date' => 'required',
            ]);
        } catch (ValidationException $validate) {
            return response()->json([
                'status' => false,
                'message' => $validate->getMessage()
            ]);
        }

        try {
            $request->merge([
                'appointment' => $appointment
            ]);
            $dto = UpdateAppointmentDTO::fromArray($request->all());
            $response = $action->execute($dto);
            return response()
                ->json([
                    'status' => true,
                    'message' => 'Appointment updated successfully.',
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
