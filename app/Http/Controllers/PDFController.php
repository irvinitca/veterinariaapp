<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;


class PDFController extends Controller
{
    //
    public function generatePDFPaciente(Request $request)
    {
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');
        $user_id = $request->input('user_id');

        // Validar si los parámetros son requeridos
        if (!$date_start || !$date_end || !$user_id) {
            return response()->json(['error' => 'Los parámetros date_start, date_end y user_id son requeridos.'], 400);
        }

        $user=User::find($user_id);
        $appointments = DB::table('appointments')
        ->join('pets', 'appointments.pet_id', '=', 'pets.id')
        ->join('owners', 'pets.owner_id', '=', 'owners.id')
        ->select('pets.name as pet_name', 'appointments.date_start','appointments.reason', 'appointments.total', 'owners.name as owner_name')
        ->where('appointments.date_start', '>=', $date_start)
        ->where('appointments.date_start', '<=', $date_end)
        ->where('appointments.user_id', $user_id)
        ->whereIn('status', ['Activo', 'Pagado'])
        ->orderBy('appointments.date_start')
        ->get();

        $data = [
            'title' => 'Reportes de pacientes del Dr.'.$user->name,
            'desde' => Carbon::parse($date_start)->format('d M y H:i:s'),
            'hasta' => Carbon::parse($date_end)->format('d M y H:i:s'),
            'name' => $user->name,
            'appointments' =>$appointments
        ];

        $pdf = PDF::loadView('admin.reportePacientesVeterinario', $data);

        return $pdf->download('reportePacientes.pdf');
    }
    public function generatePDFUsers()
    {
        $users = User::get();

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $users
        ];

        $pdf = PDF::loadView('admin.reportePacientesVeterinario', $data);

        return $pdf->stream('reporteUser.pdf');
    }
    public function pdfPacientes (){

        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Veterinario');
            }
        )->get();

        return view('admin.formReportePacientesVeterinario', compact('users'));
    }

    public function generatePDFIngresos(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $type = $request->input('type');

        if (!$month || !$year || !$type) {
            return response()->json(['error' => 'Los parámetros month, year y type son requeridos.'], 400);
        }

        $start_date = Carbon::create($year, $month, 1)->startOfMonth();
        $end_date = Carbon::create($year, $month, 1)->endOfMonth();

        $monthName = Carbon::create()->month($month)->formatLocalized('%B');

        $appointments = Appointment::with('pet')
        ->select('id','date_start', 'pet_id', 'total', 'type')
        ->where('type', $type)
        ->whereBetween('date_start', [$start_date, $end_date])
        ->get();

            $data = [
                'title' => 'Reporte de Ingresos Mensuales',
                'month' => $month,
                'monthName' => $monthName,
                'year' => $year,
                'type' => $type,
                'total' => $appointments->sum('total'),
                'appointments' => $appointments
            ];

        $pdf = PDF::loadView('admin.reporteIngresosMes', $data);

        return $pdf->download('reporteIngresosPorMes.pdf');
    }


    public function pdfIngresos (){

        $appointments = Appointment::pluck('type')->unique();

        return view('admin.formReporteIngresosMes' , compact('appointments'));
    }

}
