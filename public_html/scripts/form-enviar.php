<?php 

error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once("phpmailer2/class.phpmailer.php");
require_once("phpmailer2/class.smtp.php");

$mail = new PHPMailer;

// $mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'email-ssl.com.br';                           // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'contato@tilsbr.com.br';                 // SMTP username
$mail->Password = 'SlIt@91735460*';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('contato@tilsbr.com.br', utf8_decode('Empresa'));
$mail->addAddress('contato@tilsbr.com.br');
$mail->addReplyTo($_POST['email'], $_POST['nome']);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = utf8_decode('Assunto');

$data = $_POST;

$trans = array('name' => 'Nome', 'email' => 'E-mail', 'model'=>'Modelo', 'numero_de_parcelas'=> 'Número de Parcelas', 'valor_da_entrada' => 'Valor Entrada', 'phone' => 'Telefone', 'message' => 'Mensagem', 'city' => 'Cidade', 'state' => "Estado", 'cidade_agd' => 'Cidade de Agendamento');

$message = '';
foreach($data as $field => $value){
    if (isset($trans[$field])) {
        $field = $trans[$field];
    }

    $message .= '<b>' . ucfirst(strtolower($field)) . '</b>' . ': ' . $value . '<br>';

}

$mail->Body = utf8_decode($message); 


if(!$mail->send()) {
    die('ERROR');
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    die('OK');	
}

?>