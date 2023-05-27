<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    //
    public function generatePDFPaciente()
    {
        $users = User::get();

        $data = [
            'title' => 'Reportes de pacientes por veterinario(Mensual)',
            'date' => date('m/d/Y'),
            'users' => $users
        ];

        $pdf = PDF::loadView('admin.reportePacientesVeterinario', $data);

        return $pdf->stream('reportePacientes.pdf');
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
}
