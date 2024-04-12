<?php 
// include_once("../../banco/config.php");
// require_once("../../libs/PHPMailer/src/PHPMailer.php");
// require_once("../../libs/PHPMailer/src/Exception.php");
// require_once("../../libs/PHPMailer/src/SMTP.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\SMTP;

class Mail{

    const HOST = 'smtp.gmail.com';
    const USER = 'luciliodetales@gmail.com';
    const PASS = 'mdujqjnuohjnjluc';
    const SECURE= PHPMailer::ENCRYPTION_STARTTLS;
    const PORT = 587;
    const CHARSET = 'UTF-8';

    const FROM_EMAIL = 'comercial@esmeargangola.ao';
    const FROM_NAME  = 'ESMEARQ';

    public $error;

    private $addresses;
    private $mensagem;
    private $assunto;
    private $headers;
    private $obMail;
    private $attachments;

    

    public function __construct($addresses,$assunto_ ="Notificação Esmeark", $mensagem_ = "Esta é uma mensagem da Esmeark",$bccs=[],$ccs=[],$attachments=[]) {
        $this->addresses = $addresses;
        $this->assunto = $assunto_;
        $this->mensagem = $mensagem_;
        $this->attachments = $attachments;
        $this->obMail = new PHPMailer(true);

        // CREDENCIAIS DE ACESSO AO SMTP
        $this->setCredentials();
        $this->setHeaders($ccs,$bccs);
        
        // REMETENTE
        $this->obMail->setFrom(self::FROM_EMAIL,self::FROM_NAME);
        $this->obMail->addReplyTo(self::FROM_EMAIL, self::FROM_NAME);

        // DESTINATARIO
        $this->setDest();

        // CONTEUDO
        $this->setContent();
        
         
         
    }

    private function setCredentials()
    {
        // CREDENCIAIS DE ACESSO AO SMTP
        $this->obMail->isSMTP(true);
        $this->obMail->Host = self::HOST;
        $this->obMail->SMTPAuth = true;
        $this->obMail->Username = self::USER;
        $this->obMail->Password = self::PASS;
        $this->obMail->SMTPSecure = self::SECURE;
        $this->obMail->Port = self::PORT;
        $this->obMail->CharSet = self::CHARSET;
    }

    private function setHeaders($ccs,$bccs)
    {
        // CCS
        $ccs = is_array($ccs)? $ccs : [$ccs];
        foreach($ccs as $cc){
            $this->obMail->addCC($cc);
        }

        // BCC
        $bccs = is_array($bccs)? $bccs : [$bccs];
        foreach($bccs as $bcc){
            $this->obMail->addBCC($bcc);
        }
    }

    private function setDest()
    {
        $addresses = is_array($this->addresses)? $this->addresses : [$this->addresses];
         foreach($addresses as $address){
             $this->obMail->addAddress($address);
         }
    }

    private function  setAttachments()
    {
        // ANEXOS
        $attachments = is_array($this->attachments)? $this->attachments : [$this->attachments];
        foreach($attachments as $attachment){
            $this->obMail->addAttachment($attachment);
        }
    }

    private function setContent()
    {
        // CONTEUDO

        $this->obMail->isHtml(true);
        $this->obMail->Subject = $this->assunto;
        $this->obMail->Body = $this->mensagem;
    }

    public function send()
    {
        
        try{
             return $this->obMail->send();
        }catch(PHPMailerException $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }


}

?>