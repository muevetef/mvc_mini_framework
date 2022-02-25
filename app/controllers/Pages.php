<?php

use PHPMailer\PHPMailer\PHPMailer;

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = ['title' => 'Bienvenidos'];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = ['title' => 'Sobre mi y nada más'];
        $this->view('pages/about', $data);
    }

    private function sendEmail($data)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
        $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
        $mail->Port = 587; // TLS only
        $mail->SMTPSecure = 'tls'; // ssl is deprecated
        $mail->SMTPAuth = true;
        $mail->Username = 'easyrobotics2@gmail.com'; // email
        $mail->Password = ''; // password
        $mail->setFrom('system@cksoftwares.com', 'CKSoftwares System'); // From email and name
        $mail->addAddress('easyrobotics2@gmail.com', 'Mr. Brown'); // to email and name
        $mail->Subject = $data['asunto'];
        $mail->msgHTML($data['msg']); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
        $mail->AltBody = $data['msg']; // If html emails is not supported by the receiver, show this body
        // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }

    public function contact()
    {
        echo "contacts";
        //Mirar si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Procesar el formulario
            //Sanitizar los datos
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //Inicializar los datos
            $data = [
                'asunto' => trim($_POST['asunto']),
                'msg' => trim($_POST['msg']),
                'asunto_err' => '',
                'msg_err' => ''
            ];
            if (empty($data['asunto'])) {
                $data['asunto_err'] = 'Escribe un asunto';
            }
            if (empty($data['msg'])) {
                $data['msg_err'] = 'Escribe un msg';
            }

            //Si no hay errores registramos el usuario
            if (
                empty($data['asunto_err'])
                && empty($data['msg_err'])

            ) {

                $this->sendEmail($data);
                redirect('pages');
            } else {
                //Si hay errores cargamos la vista con los errores
                $this->view('pages/contact', $data);
            }
        } else {
            //Inicializar los datos
            $data = [
                'asunto' => '',
                'msg' => '',
                'asunto_err' => '',
                'msg_err' => '',
            ];
            //
            //Cargar la vista
            $this->view('pages/contact', $data);
        }
    }
}
