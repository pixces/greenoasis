<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 19/12/12
 * Time: 11:42 PM
 * To change this template use File | Settings | File Templates.
 */
class Mailer
{
    public $variables = array();
    public $body;
    public $_template;
    public $toAdmin = false;
    public $mailer;
    public $layout = "email_template";

    //public $templatePath = ROOT."/application/views/emails/";

    public function __construct($smtp = true)
    {

        $this->mailer = new PHPMailer();

        if ($smtp) {
            $this->mailer->IsSMTP();
            $this->mailer->IsHTML();
            $this->mailer->CharSet="UTF-8";
            $this->mailer->SMTPAuth = true;
            $this->mailer->SMTPSecure = "tls";
            $this->mailer->Host = "smtp.gmail.com";
            $this->mailer->Port = 587;
            $this->mailer->Username = "pixces@gmail.com";
            $this->mailer->Password = "zoya$123";
            //$this->mailer->SMTPDebug = 2;

        }

        if ($this->toAdmin) {
            #add admin as a CC to this list
            $this->mailer->AddBCC(ADMIN_EMAIL);
        }
    }

    public function addAddress($address, $alias = "")
    {
        $this->mailer->AddAddress($address, $alias);
    }

    public function setData($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function setTemplate($template)
    {

        $this->_template = $template;
    }

    public function setSubject($subject)
    {
        $this->mailer->Subject = '[GreenOasis] ' . $subject;
    }

    public function setFrom($email = '', $name = '')
    {
        if (empty($email)) {
            $this->mailer->SetFrom(ADMIN_EMAIL, 'GreenOasis');
        } else {
            $this->mailer->SetFrom($email, $name);
        }
    }

    public function addReplyTo($email = '', $name = '')
    {
        if (empty($email)) {
            $this->mailer->SetFrom(ADMIN_EMAIL, 'GreenOasis');
        } else {
            $this->mailer->SetFrom($email, $name);
        }
    }

    public function getLayout()
    {
        if ($this->layout) {
            return ROOT . DS . 'application' . DS . 'views' . DS . 'emails' . DS . $this->layout . ".php";
        }
        return false;
    }


    public function messageBody()
    {
        ob_start();
        $templatePath = ROOT . DS . 'application' . DS . 'views' . DS . 'emails' . DS;

        extract($this->variables);

        $templateName = $this->_template . '.php';
        $filename = $templatePath . $templateName;

        //rendering the email content
        include $filename;
        $emailContent = ob_get_contents();
        ob_end_clean();

        ob_start();
        //put email content with the layout
        include $this->getLayout();
        $output = ob_get_contents();
        ob_end_clean();

        $this->mailer->MsgHTML($output);
    }

    public function sendEmail()
    {

        #create the message body and allocate it to mailer
        $this->messageBody();

        //set from emails
        $this->setFrom();

        //set reply to
        $this->addReplyTo();

        try {
            if ( $this->mailer->Send() ){
                return true;
            } else {
                print_r( $this->mailer->ErrorInfo );
                return false;
            }

        } catch (Exception $e) {
            throw new Exception( $e->getMessage() );
        }
    }
}
