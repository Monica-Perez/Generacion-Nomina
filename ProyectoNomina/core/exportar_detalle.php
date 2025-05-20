<?php
require_once '../Config/db.php';
require_once '../Models/NominaModelo.php';
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

if (!isset($_GET['id'])) {
    die('ID de nómina no proporcionado.');
}

$id = $_GET['id'];

$db = db::conectar();
$modelo = new NominaModelo($db);
$nomina = $modelo->obtenerNominaPorId($id);

if (!$nomina) {
    die('Nómina no encontrada.');
}

$nomina = $modelo->obtenerNominaPorId($id);
$resumen = $modelo->resumenNomina($id);
$distribucion = $modelo->calcularDistribucion($id);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Detalle Nómina");

$bold = ['font' => ['bold' => true]];
$border = ['borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]];
$center = ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]];

$sheet->mergeCells('A1:B1');
$sheet->setCellValue('A1', 'Detalle de Nómina Individual');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->applyFromArray($center);

$row = 3;
$sheet->setCellValue("A$row", "Empleado:");
$sheet->setCellValue("B$row", $nomina['nombre_empleado']); $row++;
$sheet->setCellValue("A$row", "Tipo de Nómina:");
$sheet->setCellValue("B$row", $nomina['Tipo_Nomina']); $row++;
$sheet->setCellValue("A$row", "Fecha:");
$sheet->setCellValue("B$row", date('d/m/Y', strtotime($nomina['Fecha_Nomina']))); $row++;

$row++;

$sheet->setCellValue("A$row", "Salario Base Mensual");
$sheet->setCellValue("B$row", $resumen['salario_base']); $row++;
$sheet->setCellValue("A$row", "Bono Incentivo");
$sheet->setCellValue("B$row", $resumen['bono_incentivo']); $row++;
$sheet->setCellValue("A$row", "Bono Antigüedad");
$sheet->setCellValue("B$row", $resumen['bono_antiguedad']); $row++;
$sheet->setCellValue("A$row", "Bono Horas Extra");
$sheet->setCellValue("B$row", $resumen['bono_horas_extras']); $row++;
$sheet->setCellValue("A$row", "Total Bonificaciones");
$sheet->setCellValue("B$row", $resumen['total_bonos']); $row++;
$sheet->setCellValue("A$row", "ISR");
$sheet->setCellValue("B$row", $resumen['ISR']); $row++;
$sheet->setCellValue("A$row", "IGSS");
$sheet->setCellValue("B$row", $resumen['IGSS']); $row++;
$sheet->setCellValue("A$row", "Total Deducciones");
$sheet->setCellValue("B$row", $resumen['total_deducciones']); $row++;
$sheet->setCellValue("A$row", "Total Neto del Mes");
$sheet->setCellValue("B$row", $resumen['total_neto']); $row++;

$row++;

if (!empty($distribucion)) {
    $sheet->setCellValue("A$row", "Distribución por Periodo");
    $sheet->mergeCells("A$row:B$row");
    $sheet->getStyle("A$row")->getFont()->setBold(true); $row++;

    foreach ($distribucion as $fila) {
        $sheet->setCellValue("A$row", $fila['periodo']);
        $sheet->setCellValue("B$row", $fila['monto']);
        $row++;
    }
}

$sheet->getStyle("A3:A$row")->applyFromArray($bold);
$sheet->getStyle("A3:B$row")->applyFromArray($border);
$sheet->getStyle("B3:B$row")->getNumberFormat()->setFormatCode('#,##0.00');

$sheet->getColumnDimension('A')->setWidth(35);
$sheet->getColumnDimension('B')->setWidth(20);

ob_clean();
$filename = 'detalle_nomina_' . $nomina['ID_Nomina'] . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;