<?php
// Include the FPDF library
require('fpdf.php');

// Shop information
$shopName = "FOOD WORLD Order Report";
$phone = "9876543210";
$email = "foodworld654@gmail.com"; // Note: You mentioned to remove the border here, but this is just the variable assignment
$address = "56/9, Kumaran Street, RKV Road, Erode-638145";

// Get the current date
$currentDate = date('Y-m-d'); // Format: YYYY-MM-DD

// Sample data (this data could come from a database)
$orders = [
    ['orderId' => 'ORD12345', 'productName' => 'Product A', 'userName' => 'John Doe', 'qty' => 2, 'orderDate' => '2024-10-10', 'deliveredDate' => '2024-10-12', 'price' => 100],
    ['orderId' => 'ORD12346', 'productName' => 'Product B', 'userName' => 'Jane Smith', 'qty' => 1, 'orderDate' => '2024-10-11', 'deliveredDate' => '2024-10-13', 'price' => 50],
    ['orderId' => 'ORD12347', 'productName' => 'Product C', 'userName' => 'Alice Johnson', 'qty' => 3, 'orderDate' => '2024-10-12', 'deliveredDate' => '2024-10-14', 'price' => 75],
    ['orderId' => 'ORD12345', 'productName' => 'Product A', 'userName' => 'John Doe', 'qty' => 2, 'orderDate' => '2024-10-10', 'deliveredDate' => '2024-10-12', 'price' => 100],
    ['orderId' => 'ORD12346', 'productName' => 'Product B', 'userName' => 'Jane Smith', 'qty' => 1, 'orderDate' => '2024-10-11', 'deliveredDate' => '2024-10-13', 'price' => 50],
    ['orderId' => 'ORD12347', 'productName' => 'Product C', 'userName' => 'Alice Johnson', 'qty' => 3, 'orderDate' => '2024-10-12', 'deliveredDate' => '2024-10-14', 'price' => 75],
    ['orderId' => 'ORD12345', 'productName' => 'Product A', 'userName' => 'John Doe', 'qty' => 2, 'orderDate' => '2024-10-10', 'deliveredDate' => '2024-10-12', 'price' => 100],
    ['orderId' => 'ORD12346', 'productName' => 'Product B', 'userName' => 'Jane Smith', 'qty' => 1, 'orderDate' => '2024-10-11', 'deliveredDate' => '2024-10-13', 'price' => 50],
    ['orderId' => 'ORD12347', 'productName' => 'Product C', 'userName' => 'Alice Johnson', 'qty' => 3, 'orderDate' => '2024-10-12', 'deliveredDate' => '2024-10-14', 'price' => 75],
    ['orderId' => 'ORD12345', 'productName' => 'Product A', 'userName' => 'John Doe', 'qty' => 2, 'orderDate' => '2024-10-10', 'deliveredDate' => '2024-10-12', 'price' => 100],
    ['orderId' => 'ORD12346', 'productName' => 'Product B', 'userName' => 'Jane Smith', 'qty' => 1, 'orderDate' => '2024-10-11', 'deliveredDate' => '2024-10-13', 'price' => 50],
    ['orderId' => 'ORD12347', 'productName' => 'Product C', 'userName' => 'Alice Johnson', 'qty' => 3, 'orderDate' => '2024-10-12', 'deliveredDate' => '2024-10-14', 'price' => 75],
    ['orderId' => 'ORD12345', 'productName' => 'Product A', 'userName' => 'John Doe', 'qty' => 2, 'orderDate' => '2024-10-10', 'deliveredDate' => '2024-10-12', 'price' => 100],
    ['orderId' => 'ORD12346', 'productName' => 'Product B', 'userName' => 'Jane Smith', 'qty' => 1, 'orderDate' => '2024-10-11', 'deliveredDate' => '2024-10-13', 'price' => 50],
    ['orderId' => 'ORD12347', 'productName' => 'Product C', 'userName' => 'Alice Johnson', 'qty' => 3, 'orderDate' => '2024-10-12', 'deliveredDate' => '2024-10-14', 'price' => 75],
    ['orderId' => 'ORD12345', 'productName' => 'Product A', 'userName' => 'John Doe', 'qty' => 2, 'orderDate' => '2024-10-10', 'deliveredDate' => '2024-10-12', 'price' => 100],
    ['orderId' => 'ORD12346', 'productName' => 'Product B', 'userName' => 'Jane Smith', 'qty' => 1, 'orderDate' => '2024-10-11', 'deliveredDate' => '2024-10-13', 'price' => 50],
    ['orderId' => 'ORD12347', 'productName' => 'Product C', 'userName' => 'Alice Johnson', 'qty' => 3, 'orderDate' => '2024-10-12', 'deliveredDate' => '2024-10-14', 'price' => 75],
    // Add more orders as needed
];

// Create a new instance of FPDF with Landscape orientation
$pdf = new FPDF('L', 'mm', 'A4'); // 'L' stands for Landscape

// Set margins (left, top, and right margins set to 10mm)
$pdf->SetMargins(10, 10, 10);  // Left, Top, Right margins

// Set Auto Page Break with a bottom margin of 10mm
$pdf->SetAutoPageBreak(true, 10);  // Bottom margin of 10mm

// Add a new page to the document
$pdf->AddPage();

// Shop details (center-aligned)
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 6, 'Date: ' . $currentDate, 0, 1, 'R'); // Right aligned
$pdf->Ln(-7);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, $shopName, 0, 1, 'C');

// Phone number and email on the same line
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 6, 'Phone: ' . $phone . ' | Email: ' . $email, 0, 1, 'C');

// Address on a separate line
$pdf->Cell(0, 6, 'Address: ' . $address, 0, 1, 'C');

// Line break before the table description
$pdf->Ln(5);

// Add a description for the report (left-aligned)
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 6, 'This report contains a detailed summary of recent orders.', 0, 1, 'L');

// Line break before the table
$pdf->Ln(5);

// Set font for the table header
$pdf->SetFont('Arial', 'B', 12);

// Add table headers (with proper width for landscape)
$pdf->Cell(30, 10, 'Order ID', 1, 0, 'C');
$pdf->Cell(60, 10, 'Product Name', 1, 0, 'C');
$pdf->Cell(60, 10, 'User Name', 1, 0, 'C');
$pdf->Cell(20, 10, 'Qty', 1, 0, 'C');
$pdf->Cell(40, 10, 'Order Date', 1, 0, 'C');
$pdf->Cell(40, 10, 'Delivered Date', 1, 0, 'C');
$pdf->Cell(30, 10, 'Price', 1, 0, 'C');
$pdf->Ln();

// Set font for table content
$pdf->SetFont('Arial', '', 12);

// Initialize totals
$totalQty = 0;
$totalPrice = 0;

// Loop through the orders and add rows
foreach ($orders as $order) {
    $pdf->Cell(30, 10, $order['orderId'], 1, 0, 'C');        // Order ID
    $pdf->Cell(60, 10, $order['productName'], 1, 0, 'C');     // Product Name (left aligned)
    $pdf->Cell(60, 10, $order['userName'], 1, 0, 'C');        // User Name (left aligned)
    $pdf->Cell(20, 10, $order['qty'], 1, 0, 'C');             // Quantity (center aligned)
    $pdf->Cell(40, 10, $order['orderDate'], 1, 0, 'C');       // Order Date (center aligned)
    $pdf->Cell(40, 10, $order['deliveredDate'], 1, 0, 'C');   // Delivered Date (center aligned)
    $pdf->Cell(30, 10, '$' . number_format($order['price'], 2), 1, 0, 'C'); // Price (right aligned)
    $pdf->Ln();

    // Calculate totals
    $totalQty += $order['qty'];
    $totalPrice += $order['price'];
}

// Calculate total orders
$totalOrders = count($orders);

// Add totals section
// Add a line break before totals
$pdf->Ln(10); // Line break before totals

// Set font for totals
$pdf->SetFont('Arial', 'B', 12);

// Create a table for totals with proper alignment
$pdf->Cell(29, 10, 'Total Orders', 0, 0, 'L');
$pdf->Cell(3, 10, ':', 0, 0, 'L'); // Left-aligned label
$pdf->Cell(5, 10, $totalOrders, 0, 1, 'L'); // Right-aligned value

$pdf->Cell(29, 10, 'Total Quantity', 0, 0, 'L'); // Left-aligned label
$pdf->Cell(3, 10, ':', 0, 0, 'L'); // Left-aligned label
$pdf->Cell(5, 10, $totalQty, 0, 1, 'L'); // Right-aligned value

$pdf->Cell(29, 10, 'Total Price', 0, 0, 'L'); // Left-aligned label
$pdf->Cell(3, 10, ':', 0, 0, 'L'); // Left-aligned label
$pdf->Cell(5, 10, '$' . number_format($totalPrice, 2), 0, 1, 'L'); // Right-aligned value


// Output the PDF to the browser
$pdf->Output();
?>
