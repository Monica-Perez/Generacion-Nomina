<?php
require_once '../Config/db.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$db = db::conectar();
$stmt = $db->prepare("
    SELECT 
        n.*, 
        CONCAT(emp.PriNombre_Emp, ' ', emp.SegNombre_Emp, ' ', emp.PriApellido_Emp, ' ', emp.SegApellido_Emp) AS nombre_empleado
    FROM nomina n
    JOIN empleado emp ON n.ID_Emp = emp.ID_Emp
    ORDER BY n.Fecha_Nomina DESC
");
$stmt->execute();
$nominas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Nómina');

$encabezados = [
    'Empleado', 'Tipo de Nómina', 'Fecha', 'Salario Base (Q)',
    'Bono Incentivo (Q)', 'Bono Antigüedad (Q)', 'Bono Horas Extra (Q)',
    'ISR (Q)', 'IGSS (Q)', 'Total Neto (Q)'
];

$sheet->fromArray($encabezados, null, 'A1');

$headerStyle = [
    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F81BD']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
];

$sheet->getStyle('A1:J1')->applyFromArray($headerStyle);

$row = 2;
foreach ($nominas as $n) {
    $sheet->setCellValue("A$row", $n['nombre_empleado']);
    $sheet->setCellValue("B$row", $n['Tipo_Nomina']);
    $sheet->setCellValue("C$row", date('d/m/Y', strtotime($n['Fecha_Nomina'])));
    $sheet->setCellValue("D$row", $n['Salario_Base']);
    $sheet->setCellValue("E$row", $n['Bono_Incentivo']);
    $sheet->setCellValue("F$row", $n['Bono_Antiguedad']);
    $sheet->setCellValue("G$row", $n['Bono_HorasExtras']);
    $sheet->setCellValue("H$row", $n['ISR']);
    $sheet->setCellValue("I$row", $n['IGSS']);
    $sheet->setCellValue("J$row", $n['Total_Neto']);

    $sheet->getStyle("A$row:J$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("A$row:J$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $row++;
}

foreach (range('A', 'J') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

ob_clean(); // Limpieza de bufer 
$filename = 'nomina_' . date('Y_m') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;