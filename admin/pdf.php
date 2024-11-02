<?php
// Check if this script is being accessed directly for PDF generation
// database connection
include './../database.php';

// Check for connection error
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['query']))
{
        $add__date_qry="";
        if(isset($_POST['f_date']) && isset($_POST['t_date']))
         {
            $from_date=$_POST['f_date'];
            $to_date=$_POST['t_date'];
            $add__date_qry=" AND d_date BETWEEN '$from_date' and '$to_date 23:59:59'";
         }
         elseif($_POST['f_date'])
         {
            $from_date=$_POST['f_date'];
            $to_date=date('Y-m-d');
            $add__date_qry=" AND d_date BETWEEN '$from_date' and '$to_date 23:59:59'";
         }
         elseif($_POST['t_date'])
         {
            $to_date=$_POST['t_date'];
            $add__date_qry=" AND d_date<='$to_date 23:59:59'";
         }
$select_qry = $_POST['query'].$add__date_qry;;
$result_select = mysqli_query($con, $select_qry);
$num = mysqli_num_rows($result_select);
// $row = mysqli_fetch_array($result_select);


// Start output buffering to avoid header issues
ob_start();

// Include the FPDF library
require('./fpdf/fpdf.php');

// Shop information
$shopName = "FOOD WORLD Order Report";
$phone = "9876543210";
$email = "foodworld654@gmail.com";
$address = "56/9, Kumaran Street, RKV Road, Erode-638145";

// Get the current date
$currentDate = date('F j, Y');

// Create a new instance of FPDF with Landscape orientation
$pdf = new FPDF('L', 'mm', 'A3');

// Set margins and auto page break
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);

// Add a new page to the document
$pdf->AddPage();

// Shop details (center-aligned)
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 6, 'Date: ' . $currentDate, 0, 1, 'R');
$pdf->Ln(-7);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, $shopName, 0, 1, 'C');

// Phone number and email
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 6, 'Phone: ' . $phone . ' | Email: ' . $email, 0, 1, 'C');
$pdf->Cell(0, 6, 'Address: ' . $address, 0, 1, 'C');

// Line break before the table description
$pdf->Ln(5);

// Add report description
// $pdf->SetFont('Arial', 'I', 12);
// $pdf->Cell(0, 6, 'This report contains a detailed summary of recent orders.', 0, 1, 'L');
// $pdf->Ln(5);

// Define the total width of the table
$tableWidth = 30 + 60 + 60 + 20 + 60 + 60 + 30 + 50; // Sum of column widths

// Calculate the X position for center alignment (A3 width is 420mm, with 10mm margins on both sides)
$centerX = (420 - $tableWidth) / 2;

// Table headers (centered)
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX($centerX); // Move to the calculated X position
$pdf->Cell(30, 10, 'Order ID', 1, 0, 'C');
$pdf->Cell(60, 10, 'Product Name', 1, 0, 'C');
$pdf->Cell(60, 10, 'User Name', 1, 0, 'C');
$pdf->Cell(20, 10, 'Qty', 1, 0, 'C');
$pdf->Cell(60, 10, 'Order Date', 1, 0, 'C');
$pdf->Cell(60, 10, 'Delivered Date', 1, 0, 'C');
$pdf->Cell(30, 10, 'Price', 1, 0, 'C');
$pdf->Cell(50, 10, 'Payment type', 1, 0, 'C');
$pdf->Ln();

// Initialize totals
$totalQty = 0;
$totalPrice = 0;
$total_order=0;
// Table content (centered)
$pdf->SetFont('Arial', '', 12);

if ($num > 0) {
    while ($row = mysqli_fetch_array($result_select)) {
        // Fetch joined data
        $pay_id = $row['payment_id'];
        $user_id = $row['user_id'];
        $product_id = $row['product_id'];
        $select_qry_join = "SELECT pay.payment_type, u.user_name, pro.product_name 
                            FROM payment pay, product pro, user u 
                            WHERE pay.payment_id = $pay_id AND u.user_id = $user_id AND pro.product_id = $product_id";
        $result_select_join = mysqli_query($con, $select_qry_join);
        $row_join = mysqli_fetch_array($result_select_join);

        // Set X position for each row
        $pdf->SetX($centerX);

        // Add table data
        $pdf->Cell(30, 10, $row['o_id'], 1, 0, 'C');
        $pdf->Cell(60, 10, $row_join['product_name'], 1, 0, 'C');
        $pdf->Cell(60, 10, $row_join['user_name'], 1, 0, 'C');
        $pdf->Cell(20, 10, $row['qty'], 1, 0, 'C');
        $pdf->Cell(60, 10, $row['o_date'], 1, 0, 'C');
        $pdf->Cell(60, 10, $row['d_date'], 1, 0, 'C');
        $pdf->Cell(30, 10,  number_format($row['o_price'], 2), 1, 0, 'C');
        $pdf->Cell(50, 10, $row_join['payment_type'], 1, 0, 'C');
        $pdf->Ln();

        // Calculate totals
        $totalQty += $row['qty'];
        $totalPrice += $row['o_price'];
        $total_order+=1;
    }
} else {
    // No orders found message
    $pdf->Cell(0, 10, 'No orders found for the given criteria.', 0, 1, 'C');
}

// Add totals section
// After processing all orders and before outputting the PDF
// Add space before totals section
$pdf->Ln(10);

// Set font for totals section
$pdf->SetFont('Arial', 'B', 12);

// Move cursor to the right by 5rem (approximately 21.12mm)
$pdf->SetX($pdf->GetX() + 43.12);

// Total Orders
$pdf->Cell(29, 10, 'Total Orders', 0, 0, 'L');
$pdf->Cell(3, 10, ':', 0, 0, 'L');
$pdf->Cell(5, 10, $total_order, 0, 1, 'L'); // Total orders
$pdf->SetX($pdf->GetX() + 43.12);
// Total Quantity
$pdf->Cell(29, 10, 'Total Quantity', 0, 0, 'L');
$pdf->Cell(3, 10, ':', 0, 0, 'L');
$pdf->Cell(5, 10, $totalQty, 0, 1, 'L');
$pdf->SetX($pdf->GetX() + 43.12);
// Total Price
$pdf->Cell(29, 10, 'Total Price', 0, 0, 'L');
$pdf->Cell(3, 10, ':', 0, 0, 'L');
$pdf->Cell(5, 10,   number_format($totalPrice, 2), 0, 1, 'L');

// Set headers for PDF download
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="order_report.pdf"');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');
header('Expires: 0');

// Output the PDF to the browser
// $pdf->Output('D','Food_World_.pdf');
$pdf->Output();


// End output buffering and flush the output
ob_end_flush();

// Close the database connection
mysqli_close($con);

exit; // Ensure no further output after PDF generation
}

?>
