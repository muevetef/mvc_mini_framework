<?php
class Users extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        echo "Lista de usuarios por hacer...";
    }

    public function register()
    {
        //Mirar si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Procesar el formulario
            //Sanitizar los datos
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //Inicializar los datos
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            //Validar email 
            if (empty($data['email'])) {
                $data['email_err'] = 'Por favor rellena el email';
            } else {
                //TODO Veificar que no exista en la bd
                if ($this->userModel->emailExists($data['email'])) {
                    $data['email_err'] = 'Este email la esta registrado';
                }
            }

            //Validar name
            if (empty($data['name'])) {
                $data['name_err'] = 'Escribe un nombre';
            }

            //Validar password
            if (empty($data['password'])) {
                $data['password_err'] = 'Te falta el password';
            } elseif (mb_strlen($data['password']) < 6) {
                $data['password_err'] = 'EL password debe tener 6 o más caracteres';
            }

            //Validar confirmacion password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Confirma el password';
            } elseif ($data['password'] !== $data['confirm_password']) {
                $data['confirm_password_err'] = 'Los passwords no coinciden';
            }


            //Si no hay errores registramos el usuario
            if (
                empty($data['email_err'])
                && empty($data['name_err'])
                && empty($data['password_err'])
                && empty($data['confirm_password_err'])
            ) {
                //Encriptar el password

                //Registrar el User
                if ($this->userModel->register($data)) {
                    //AUX Funcs...
                    echo "Ususario regitrado correctamente...";
                    //header('Location:'. URLROOT . '/users/login');
                } else {
                    die("Algo ha ido mal");
                }
            } else {
                //Si hay errores cargamos la vista con los errores
                $this->view('users/register', $data);
            }
        } else {
            //Inicializar los datos
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            //
            //Cargar la vista
            $this->view('users/register', $data);
        }
    }
}
