<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if ($email === false) {
        echo 'Correo electrónico inválido.';
        exit;
    }

    $message = $_POST['message'];

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tuyushireyes@gmail.com';
        $mail->Password = 'ydst ojxs ncwl dtwb';  // Reemplaza con tu contraseña o contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('tuyushireyes@gmail.com', 'Tanis');
        $mail->addAddress($email); 

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Prueba de correo';
        $mail->Body    = $message;

        $mail->send();
        echo 'Correo enviado con éxito.';
    } catch (Exception $e) {
        echo "Error al enviar el correo. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
