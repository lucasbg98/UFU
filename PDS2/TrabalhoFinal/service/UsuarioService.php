<?php

require_once("../model/Usuario.php");
require_once("../dao/UsuarioDAO.php");

class UsuarioService
{
    public static function handleCreateNewUser($args): ?Usuario
    {
        $userAlreadyExists = UsuarioDAO::read(array("getByEmail", $args["email"]));

        if ($userAlreadyExists) {
            return null;
        }

        $usuario = new Usuario();
        $usuario->setId((int) $args["id"]);
        $usuario->setEmail($args["email"]);
        $usuario->setSenha($args["senha"]);
        $usuario->setUsername($args["username"]);
        $usuario->setNome($args["nome"]);
        $usuario->setPrivilegio($args["privilegio"]);

        if (isset($args["otherProfile"])) {
            // to do -> write info in csv file, like "id, sugestion"
        }

        return UsuarioDAO::create($usuario);
    }

    public static function getByEmail(?string $email): ?Usuario
    {
        return isset($email) ? UsuarioDAO::read(array("getByEmail", $email)) : null;
    }

    public static function getById(string $id): ?Usuario
    {
        return isset($id) ? UsuarioDAO::read(array("getById", $id)) : null;
    }

    public static function loginUser($args): ?Usuario
    {
        return isset($args) ? UsuarioDAO::read($args) : null;
    }
}
