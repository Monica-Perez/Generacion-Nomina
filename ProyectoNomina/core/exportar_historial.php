<?php
require '../vendor/autoload.php';
require_once '../Config/db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$idEmp = $_GET['id'] ?? null;
if (!$idEmp) {
    die('Empleado no especificado.');
}

$conn = db::conectar();
$stmt = $conn->prepare("CALL spHistProduEmp(:id)");
$stmt->bindParam(':id', $idEmp, PDO::PARAM_INT);
$stmt->execute();
$registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

$nombre = $registros[0]['nombre_empleado'] ?? 'Empleado';
$nombreArchivo = preg_replace('/[^A-Za-z0-9]/', '_', $nombre); // sanitiza


if (empty($registros)) {
    die('No hay datos para exportar.');
}

// Crear Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Historial Productividad');

// Encabezados
$headers = ['Mes', 'Año', 'Horas Trabajadas', 'Horas Extras', 'Horas Descanso', 'Tiempo Productivo', '% Productividad'];
$sheet->fromArray($headers, null, 'A1');

// Definir estilo
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
    $sheet->setCellValue("A$fila", $row['Mes']);
    $sheet->setCellValue("B$fila", $row['Anio']);
    $sheet->setCellValue("C$fila", $row['HorasTrabajadas']);
    $sheet->setCellValue("D$fila", $row['HorasExtras']);
    $sheet->setCellValue("E$fila", $row['HorasDescanso']);
    $sheet->setCellValue("F$fila", $row['TiempoProductivo']);
    $sheet->setCellValue("G$fila", $row['PorcentajeProductividad'] . '%');
    $fila++;
}

// Ahora sí: aplicar estilos
$sheet->getStyle('A1:G1')->applyFromArray($styleHeader);
$lastRow = $fila - 1;
$sheet->getStyle("A1:G$lastRow")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
foreach (range('A', 'G') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Descargar archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Historial_' . $nombreArchivo . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;