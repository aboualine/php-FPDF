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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Générateur de PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-primary text-white">
            <h4>Formulaire de génération PDF</h4>
        </div>
        <div class="card-body">
            <form action="pdf.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nom et Prénom</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Objet</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-control" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Générer PDF</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>