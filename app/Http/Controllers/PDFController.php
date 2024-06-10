<?php

namespace App\Http\Controllers;

use App\Models\Tenista;
use TCPDF;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $tenista = Tenista::findOrFail($id);

        // Crear una instancia de TCPDF
        $pdf = new TCPDF();

        // Configurar el documento PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('kevin');
        $pdf->SetTitle('Detalles del Tenista');
        $pdf->SetSubject('Detalles del Tenista');
        $pdf->SetKeywords('TCPDF, PDF, Laravel, Tenista');

        // Eliminar la cabecera y el pie de página
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Añadir una página
        $pdf->AddPage();

        // Crear el contenido HTML
        $html = view('tenista.pdf', compact('tenista'))->render();

        // Escribir el contenido HTML en el PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Cerrar y generar el PDF
        $pdf->Output('detalles_tenista.pdf', 'I');
    }
}
