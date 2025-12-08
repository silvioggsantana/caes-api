<?php
include_once "Usuarios.php";

class LoginService {

    public function POST() {
        $data = json_decode(file_get_contents("php://input"), true);

        $email = $data["email"] ?? null;
        $senha = $data["senha"] ?? null;

        return Usuarios::login($email, $senha);
    }
}
