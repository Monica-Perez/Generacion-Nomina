<?php
require '../vendor/autoload.php';
require_once '../Config/db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$conn = db::conectar();
$stmt = $conn->prepare("CALL spGetProduEmp()");
$stmt->execute();
$registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Crear Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Productividad General');

// Encabezados
$headers = ['Empleado', 'Puesto', 'Mes', 'Año', 'Horas Trabajadas', 'Horas Extras', 'Horas Descanso', 'Tiempo Productivo', '% Productividad'];
$sheet->fromArray($headers, null, 'A1');

// Estilo encabezado
$styleHeader = [
    'font' => ['bold' => true],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['argb' => 'FFEFEFEF']
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
];

// Cuerpo
$fila = 2;
foreach ($registros as $row) {
    $sheet->setCellValue("A$fila", $row['nombre_empleado']);
    $sheet->setCellValue("B$fila", $row['Puesto'] ?? '');
    $sheet->setCellValue("C$fila", $row['Mes']);
    $sheet->setCellValue("D$fila", $row['Anio']);
    $sheet->setCellValue("E$fila", $row['HorasTrabajadas']);
    $sheet->setCellValue("F$fila", $row['HorasExtras']);
    $sheet->setCellValue("G$fila", $row['HorasDescanso']);
    $sheet->setCellValue("H$fila", $row['TiempoProductivo']);
    $sheet->setCellValue("I$fila", $row['PorcentajeProductividad'] . '%');
    $fila++;
}

// Aplicar estilo al encabezado y formato general
$sheet->getStyle('A1:I1')->applyFromArray($styleHeader);
$lastRow = $fila - 1;
$sheet->getStyle("A1:I$lastRow")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
foreach (range('A', 'I') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Descargar archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ProductividadGeneral.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;