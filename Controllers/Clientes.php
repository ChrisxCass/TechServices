<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Clientes extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        
    }
    public function index()
    {
        if (empty($_SESSION['correoCliente'])) {
            header('Location: ' . BASE_URL);
        }
        $data['title'] = 'Tu perfil';
        $data['verificar'] = $this->model->getVerificar($_SESSION['correoCliente']);
        $this->views->getView('principal', "perfil", $data);
    }

    function registroDirecto()
    {
        //VERIFICAR QUE LOS CAMPOS DE REGISTRO ESTEN RELLENOS
        if (isset($_POST['nombre']) && isset($_POST['clave'])) {
            if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['clave'])) {
                $mensaje = array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            } else {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $verificar = $this->model->getVerificar($correo);

                if (empty($verificar)) {
                    $token = md5($correo);
                    $hash = password_hash($clave, PASSWORD_DEFAULT);
                    $data = $this->model->registroDirecto($nombre, $correo, $hash, $token);

                    if ($data > 0) {
                        $_SESSION['correoCliente'] = $correo;
                        $_SESSION['nombreCliente'] = $nombre;
                        $mensaje = array('msg' => 'registrado con exito', 'icono' => 'success', 'token' => $token);
                    } else {
                        $mensaje = array('msg' => 'error al registrarse', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'YA TIENES UNA CUENTA', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function enviarCorreo()
        {
        if (isset($_POST['correo']) && isset($_POST['token'])) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = USER_SMTP;                     //SMTP username
                $mail->Password   = PASS_SMTP;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = PORT_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('casafrancarochachristianjhoan@gmail.com', TITLE);
                $mail->addAddress($_POST['correo']);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Mensaje desde la ' . TITLE;
                $mail->Body    = 'Para verificar tu correo electronico en nuestra tienda, dar <a href="' . BASE_URL . 'clientes/verificarCorreo/' . $_POST['token'] . '">Click Aquí!</a>';
                $mail->AltBody = 'GRACIAS POR LA PREFERENCIA';
                $mail->send();
                $mensaje = array('msg' => 'CORREO ENVIADO, REVISA TU BANDEJA DE ENTRADA - SPAM', 'icono' => 'success');
            } catch (Exception $e) {
                $mensaje = array('msg' => 'ERROR AL ENVIAR CORREO' . $mail->ErrorInfo, 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'ERROR FATAL', 'icono' => 'error');
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function verificarCorreo($token)
    {
        $verificar = $this->model->getToken($token);

        if (!empty($verificar)) {
            $data = $this->model->actualizarVerify($verificar['idcliente']);
            header('Location:' . BASE_URL . 'clientes');
        }
    }

    function loginDirecto()
    {
        //VERIFICAR QUE LOS CAMPOS DE REGISTRO ESTEN RELLENOS
        if (isset($_POST['correoLogin']) && isset($_POST['claveLogin'])) {
            if (empty($_POST['correoLogin']) || empty($_POST['claveLogin'])) {
                $mensaje = array('msg' => 'TODOS LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            } else {
                $correo = $_POST['correoLogin'];
                $clave = $_POST['claveLogin'];
                $verificar = $this->model->getVerificar($correo);

                if (!empty($verificar)) {   
                    
                    if (password_verify($clave, $verificar['clave'])) {
                        $_SESSION['correoCliente'] = $verificar['correo'];
                        $_SESSION['nombreCliente'] = $verificar['nombre'];
                        $mensaje = array('msg' => 'ok', 'icono' => 'success');
                    } else {
                        $mensaje = array('msg' => 'contraseña incorrecta', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'EL CORREO NO EXISTE', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    //registrar pedidos
    public function registrarPedido()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos,true);
        if (is_array($json)) {
            $id_transaccion = $json['id'];
            $monto = $json['purchase_units'][0]['amount']['value'];
            $estado = $json['status'];
            $fecha = date('Y-m-d H:i:s');
            $email = $json['payer']['email_address'];
            $nombre = $json['payer']['name']['given_name'];
            $apellido = $json['payer']['name']['surname'];
            $direccion = $json['purchase_units'][0]['shipping']['address']['address_line_1'];
            $ciudad = $json['purchase_units'][0]['shipping']['address']['admin_area_2'];
            $email_user = $_SESSION['correoCliente'];
            $data = $this->model->registrarPedido($id_transaccion,$monto,$estado,$fecha,$email,$nombre,$apellido,$direccion,$ciudad,$email_user);
            print_r($data);
        }
    }
}
