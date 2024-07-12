<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\contatos_envio\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\contatos_envio\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\contatos_envio\PHPMailer-master\src\SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $contatos = array(
        array("nome" => $_POST['nome1'], "email" => $_POST['email1'], "telefone" => $_POST['telefone1']),
        array("nome" => $_POST['nome2'], "email" => $_POST['email2'], "telefone" => $_POST['telefone2']),
        array("nome" => $_POST['nome3'], "email" => $_POST['email3'], "telefone" => $_POST['telefone3']),
        array("nome" => $_POST['nome4'], "email" => $_POST['email4'], "telefone" => $_POST['telefone4']),
        array("nome" => $_POST['nome5'], "email" => $_POST['email5'], "telefone" => $_POST['telefone5'])
    );

    $assunto = "Comunicado Importante";

    $comunicado = "Você foi sorteado!
    Um dos grandes e mais marcantes nomes da música brasileira, o cantor Ney Matogrosso, anunciou de surpresa, na noite de 25 de Abril, o maior show da carreira.
    A apresentação em questão, produzida pela 30e, acontecerá no dia 10 de Agosto de 2024, no Allianz Parque, em São Paulo, como parte da turnê Bloco na Rua. 
    Inclusive, o anúncio veio de forma inusitada, quando o icônico cantor foi ao Love Cabaret, na capital paulista, revelar a notícia para os presentes no local, onde era o Love Story.";

    foreach ($contatos as $contato) {
        $nome = $contato['nome'];
        $email = $contato['email'];
        $telefone = $contato['telefone'];

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ana.carolina@cartoriosdeprotesto.org.br'; 
            $mail->Password = '140609ana'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; 

            $mail->setFrom('ana.carolina@cartoriosdeprotesto.org.br', 'Ana Carolina');
            $mail->addAddress($email);
            $mail->Subject = $assunto;
            $mail->Body = "Nome: $nome\nEmail: $email\nTelefone: $telefone\nComunicado: $comunicado\n\n";

            $mail->send();
        } catch (Exception $e) {
            print "Houve um erro ao enviar o e-mail para $email. Detalhes do erro: {$mail->ErrorInfo}<br>";
        }
    }
    print "Os emails foram enviados com sucesso!";
} elseif ($_SERVER['REQUEST_METHOD']== "GET") {
    print "Método errado";
}
?>
