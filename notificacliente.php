<?php
    include('verificaLogin.php');
    $cnpj = $_GET['cnpj'];
    $nf = $_GET['nf'];
    $valor = $_GET['valor'];
    $datav = new DateTime($_GET['datav']);
    $datav = $datav->format('d/m/Y');
    $usuario = $_SESSION['nome'];
    include("conexao.php");


    $consulta_nome = "select cl_nome, cl_email, cl_responsavel from tb_cliente where cl_cnpj = '$cnpj'";
    $consulta_no = mysqli_query($con, $consulta_nome);
    while($linha = mysqli_fetch_assoc($consulta_no)){
        $nome = $linha['cl_nome'];        
        $email = $linha['cl_email'];
        $responsavel = $linha['cl_responsavel'];
    }
         // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        // Load Composer's autoloader
        require 'vendor/autoload.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.mail.yahoo.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'naconengenharia@yahoo.com';                     // SMTP username
            $mail->Password   = 'keftokbxesnqfyhs';                               // SMTP password
            $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('naconengenharia@yahoo.com', 'Nacon Engenharia');
            $mail->addAddress($email, 'Cobrança de Divida');
            
            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Notificação de Conta em Atraso';
            $mail->Body    = "
            Sr(a). $responsavel da Empresa $nome, consta em nosso sistema que a conta com nota fiscal $nf no valor de R$ $valor venceu dia $datav. 

            <br>Por favor, entre em contato conosco para saldar sua dívida.<br><br>
    
            Atenciosamente,<br>
            $usuario<br>
            Nacon Engenharia";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
            $acao = "Notificou o cliente $cnpj pela conta $nf";
            include('registraMovimento.php'); 
            echo("<script>alert('Notificação enviado com sucesso!');window.close();</script>");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo("<script>alert('Falha ao enviar notificação!');</script>");
        }
?>