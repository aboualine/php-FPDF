<?php
require('fpdf186/fpdf.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $object = $_POST['object'];
    $message = $_POST['message'];

    // Save data to a text file
    $data = "Title: $title\nName: $name\nPhone: $phone\nEmail: $email\nObject: $object\nMessage: $message\n\n";
    file_put_contents("data.txt", $data, FILE_APPEND);

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Background Image
    $pdf->Image('background-annonce.png', 0, 0, 210, 297);
    
    // Title
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->SetXY(10, 20);
    $pdf->Cell(190, 10, $title, 0, 1, 'C');
    
    // Writer Info
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(10, 40);
    $pdf->MultiCell(0, 6, "Name: $name\nPhone: $phone\nEmail: $email", 0, 'L');
    
    // Object
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetXY(10, 70);
    $pdf->Cell(190, 10, "Subject: $object", 0, 1, 'L');
    
    // Message
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetXY(10, 90);
    $pdf->MultiCell(0, 6, $message, 0, 'L');
    
    // Output PDF
    $pdf->Output("generated.pdf", "D");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email Form</title>
</head>
<body>
    <form method="post">
        <label>Title:</label>
        <input type="text" name="title" required><br>
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Phone:</label>
        <input type="text" name="phone" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Object:</label>
        <input type="text" name="object" required><br>
        <label>Message:</label>
        <textarea name="message" required></textarea><br>
        <button type="submit">Generate PDF</button>
    </form>
</body>
</html>
