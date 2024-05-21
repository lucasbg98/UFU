<?php

$conexao = mysqli_connect ("localhost", "root", "lbg122010", "trabfinal", 3306);
$mysqli = new mysqli("localhost", "root", "lbg122010", "trabfinal", 3306);

if (mysqli_connect_errno()) {
  echo json_encode(array('mysqli' => 'Failed to connect to MySQL: ' . mysqli_connect_error()));
  exit;
}

$page = isset($_GET['p'])? $_GET['p'] : '';
if($page =='view'){
    $result = mysqli_query($conexao,"SELECT * FROM usuarios ");
    while($row = $result->fetch_array()){
        ?>
            <tr>
                <td><?php echo $row['cpf']?></td>
                <td><?php echo $row['nome']?></td>
                <td><?php echo $row['perfil_fk']?></td>
                <td><?php echo $row['senha']?></td>
            </tr>
        <?php
    }
}else {

    header('Content-Type: application/json');
    $input = filter_input_array(INPUT_POST);



    if ($input['action'] == 'edit') {
        $mysqli->query("UPDATE usuarios SET cpf='" . $input['cpf'] . "', nome='" . $input['nome'] . "', senha='" . md5($input['senha']) . "', perfil_fk='" . $input['perfil_fk'] . "' WHERE cpf='" . $input['cpf'] . "'");
    } else if ($input['action'] == 'delete') {
        $mysqli->query("UPDATE usuarios SET deleted=1 WHERE cpf='" . $input['cpf'] . "'");
    } else if ($input['action'] == 'restore') {
        $mysqli->query("UPDATE usuarios SET deleted=0 WHERE cpf='" . $input['cpf'] . "'");
    }

    mysqli_close($mysqli);

    echo json_encode($input);

}?>