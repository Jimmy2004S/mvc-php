<?php

namespace App\Resources;

use Lib\Resources;
use Lib\Util\ModelFormat;

class UserResources extends Resources
{
    use ModelFormat;

    public function __construct()
    {
        parent::__construct();
    }

    public function processData($data)
    {
        $json = array();
        foreach ($data as $row) {
            $role = ($row['role_id'] == 1) ? "Administrador" : ($row['role_id'] == 2 ? "Estudiante" : "Profesor");
            $json[] = array(
                'id' => $row['id'],
                'code' => $row['code'],
                'user_name' => $row['user_name'],
                'role' => $role,
                'email' => $row['email'],
                'state' => $row['state'],
            );
        }
        $this->jsonResponse($json);
    }
}
