<?php
require_once '../Config/db.php';
require '../vendor/autoload.php'; // Asegúrate que apunte a la ubicación real del autoload

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Conectar a la base
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

// Crear hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Nómina');

// Encabezados
$encabezados = [
    'Empleado', 'Tipo de Nómina', 'Fecha', 'Salario Base (Q)',
    'Bono Incentivo (Q)', 'Bono Antigüedad (Q)', 'ISR (Q)', 'IGSS (Q)', 'Total Neto (Q)'
];

$sheet->fromArray($encabezados, null, 'A1');

// Estilo para encabezados
$headerStyle = [
    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F81BD']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
];

$sheet->getStyle('A1:I1')->applyFromArray($headerStyle);

// Escribir los datos
$row = 2;
foreach ($nominas as $n) {
    $sheet->setCellValue("A$row", $n['nombre_empleado']);
    $sheet->setCellValue("B$row", $n['Tipo_Nomina']);
    $sheet->setCellValue("C$row", date('d/m/Y', strtotime($n['Fecha_Nomina'])));
    $sheet->setCellValue("D$row", $n['Salario_Base']);
    $sheet->setCellValue("E$row", $n['Bono_Incentivo']);
    $sheet->setCellValue("F$row", $n['Bono_Antiguedad']);
    $sheet->setCellValue("G$row", $n['ISR']);
    $sheet->setCellValue("H$row", $n['IGSS']);
    $sheet->setCellValue("I$row", $n['Total_Neto']);

    // Estilos para fila
    $sheet->getStyle("A$row:I$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("A$row:I$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $row++;
}

// Ajustar ancho de columnas automáticamente
foreach (range('A', 'I') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Descargar el archivo
$filename = 'nomina_' . date('Y_m') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>

