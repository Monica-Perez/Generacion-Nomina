<?php
require_once '../vendor/autoload.php';
require_once '../Models/NominaModelo.php';
require_once '../Config/db.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Usar modelo
$nominaModelo = new NominaModelo(db::conectar());
$nominas = $nominaModelo->ver();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Nómina');

$encabezados = [
    'Empleado', 'Tipo de Nómina', 'Fecha',
    'Salario Base (Q)', 'Bono Incentivo (Q)', 'Bono Antigüedad (Q)',
    'Bono Horas Extra (Q)', 'ISR (Q)', 'IGSS (Q)', 'Total Neto (Q)'
];

$sheet->fromArray($encabezados, null, 'A1');

$estiloEncabezado = [
    'font' => ['bold' => true],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['argb' => 'FFEFEFEF']
    ],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ]
];

$fila = 2;
foreach ($nominas as $n) {
    $sheet->setCellValue("A$fila", $n['nombre_empleado']);
    $sheet->setCellValue("B$fila", $n['Tipo_Nomina']);
    $sheet->setCellValue("C$fila", date('d/m/Y', strtotime($n['Fecha_Nomina'])));
    $sheet->setCellValue("D$fila", $n['Salario_Base']);
    $sheet->setCellValue("E$fila", $n['Bono_Incentivo']);
    $sheet->setCellValue("F$fila", $n['Bono_Antiguedad']);
    $sheet->setCellValue("G$fila", $n['Bono_HorasExtras']);
    $sheet->setCellValue("H$fila", $n['ISR']);
    $sheet->setCellValue("I$fila", $n['IGSS']);
    $sheet->setCellValue("J$fila", $n['Total_Neto']);
    $fila++;
}

$lastRow = $fila - 1;
$sheet->getStyle("A1:J1")->applyFromArray($estiloEncabezado);
$sheet->getStyle("A1:J$lastRow")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getStyle("A2:J$lastRow")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

foreach (range('A', 'J') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

ob_clean();
$filename = 'nomina_' . date('Y_m') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;