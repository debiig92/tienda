<?php
class Helpers extends App{
    public function showErrorPage(){
        require_once APPDIR::Views . 'error.php'; exit;
    }

    /**
    * Construye el link complementando con el dominio y protocolo
    */
    public function linkTo($route = '', $dir = '', $type = ''){
        $d = (empty($dir)) ? '' : APPDIR::getDir($dir);
        $link = (empty($type)) ? $this->BASEDIR : '';
        $link .= $d . $route;
        return $link;
    }
    
     public function sendMail($subject, $body, $address,$addressName){
        try {
            require_once APPDIR::Libs . 'phpmailer/PHPMailerAutoload.php';
            
            $mail = new PHPMailer;
            
            $mail->isSMTP();                                       // Set mailer to use SMTP
            $mail->Host = EMAIL::Host;                             // Specify main and backup SMTP servers
            $mail->SMTPAuth = EMAIL::SMTPAuth;                     // Enable SMTP authentication
            $mail->Username = EMAIL::Username;                     // SMTP username
            $mail->Password = EMAIL::Password;                     // SMTP password
            $mail->SMTPSecure = EMAIL::SMTPSecure;                 // Enable TLS encryption, `ssl` also accepted
            $mail->Port = EMAIL::Port;                             // TCP port to connect to

            $mail->From = EMAIL::From;
            $mail->FromName = EMAIL::FromName;
			
			if($this->BASEDIR==''){
                $mail->addAddress(EMAIL::AddAddress, 'Administrator');

            }else if($this->BASEDIR==''){

                $mail->addAddress(EMAIL::AddAddressDev, 'Administrator (Desarrollo)');
            }
            $mail->addAddress('', 'Administrator');//TEST
            
            $mail->addReplyTo($address, $addressName);
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = $subject;
            $mail->Body = $body;

            $mailResult="";
            if (!$mail->send()) {
                $mailResult .= 'Message could not be sent.';
                $mailResult .= 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                $mailResult = 'success';
            }
            $mail = null;

        } catch (PDOException $e) {
            $mailResult .= "DataBase Error.<br>" . $e->getMessage();

        } catch (Exception $e) {
            $mailResult .= "General Error.<br>" . $e->getMessage();
        }
        return $mailResult;
        
    }
}