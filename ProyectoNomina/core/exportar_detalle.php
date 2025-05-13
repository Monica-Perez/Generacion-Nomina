<?php
require_once '../Config/db.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

// Verificar ID
if (!isset($_GET['id'])) {
    die('ID de nómina no proporcionado.');
}

$id = $_GET['id'];

// Obtener datos de la nómina
$db = db::conectar();
$stmt = $db->prepare("
    SELECT 
        n.*, 
        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado
    FROM nomina n
    JOIN empleado e ON n.ID_Emp = e.ID_Emp
    WHERE ID_Nomina = :id
");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$nomina = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$nomina) {
    die('Nómina no encontrada.');
}

// Calcular campos extra
$bonos = $nomina['Bono_Incentivo'] + $nomina['Bono_Antiguedad'];
$deducciones = $nomina['ISR'] + $nomina['IGSS'];

// Crear archivo Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Detalle Nómina");

// Estilos
$titleFont = new Font();
$titleFont->setBold(true)->setSize(14);
$bold = ['font' => ['bold' => true]];
$border = ['borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]];

// Título
$sheet->mergeCells('A1:B1');
$sheet->setCellValue('A1', 'Detalle de Nómina Individual');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Datos
$row = 3;
$datos = [
    'Empleado' => $nomina['nombre_empleado'],
    'Tipo de Nómina' => $nomina['Tipo_Nomina'],
    'Fecha de Nómina' => date('d/m/Y', strtotime($nomina['Fecha_Nomina'])),
    'Salario Base Mensual' => $nomina['Salario_Base'],
    'Bono Incentivo' => $nomina['Bono_Incentivo'],
    'Bono Antigüedad' => $nomina['Bono_Antiguedad'],
    'Total Bonificaciones' => $bonos,
    'ISR' => $nomina['ISR'],
    'IGSS' => $nomina['IGSS'],
    'Total Deducciones' => $deducciones,
    'Total Neto del Mes' => $nomina['Total_Neto']
];

foreach ($datos as $campo => $valor) {
    $sheet->setCellValue("A$row", $campo);
    $sheet->setCellValue("B$row", $valor);
    $sheet->getStyle("A$row")->applyFromArray($bold);
    $sheet->getStyle("A$row:B$row")->applyFromArray($border);
    $sheet->getStyle("B$row")->getNumberFormat()->setFormatCode('#,##0.00');
    $row++;
}

// Ajustar ancho
$sheet->getColumnDimension('A')->setWidth(30);
$sheet->getColumnDimension('B')->setWidth(20);

// Descargar archivo
$filename = 'detalle_nomina_' . $nomina['ID_Nomina'] . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;