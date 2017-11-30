<?php

if( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
    print "<script type='text/javascript'>
        window.location.href = 'dashboard.php';
        </script>";
}


//Ligação à base de dados
$servername = "localhost";
$username = "root";
$password = "";
$bd = "tetelafut";
$conn = mysqli_connect($servername, $username, $password, $bd);
if (!$conn) {
    die("Connection Error: " . mysqli_connect_error());
}


//Verifica se o botão de registo já foi carregado ou não
if (isset($_POST['register_submit'])) {

    //Verifica se todos os campos do formulário foram preenchidos e não estão vazios
    if ((isset($_POST['firstname']) && !empty($_POST['firstname'])) && (isset($_POST['lastname']) && !empty($_POST['lastname'])) && (isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['password_confirm']) && !empty($_POST['password_confirm']))) {
        $escapedFirstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $escapedLastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $escapedMail = mysqli_real_escape_string($conn, $_POST['email']);
        $escapedPassword = mysqli_real_escape_string($conn, $_POST['password']);
        $escapedPasswordConfirm = mysqli_real_escape_string($conn, $_POST['password_confirm']);
        $rookie = 0;
        if(isset($_POST['rookie']) && $_POST['rookie'] == "on") { $rookie = 1; }

        print $rookie;


        if ($escapedPassword != $escapedPasswordConfirm) {
            print "<p class='text-white'>Passwords have to be the same</p>";
        } else {
            //Verifica se o email já existe na base de dados
            $resultados_col = mysqli_query($conn, "select col_email from colaborador where (col_email='$escapedMail');");
            $resultados_admin = mysqli_query($conn, "select admin_email from admin where (admin_email='$escapedMail');");
            if ((mysqli_num_rows($resultados_col) + mysqli_num_rows($resultados_admin)) > 0) {
                print "<p class='text-white'>Existing Email!</p>";
                //caso o mail nao existir corre o codigo abaixo
            } else {
                //verifica se o mail é valido e está bem escrito
                if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $escapedMail)) {
                    $msg = 'Invalida Email, please try again!';
                } else {
                    $msg = 'Account Created, please verify the data that we have sent to your email.';

                    $passwordHashed = password_hash($escapedPasswordConfirm, PASSWORD_DEFAULT);
                    $nome_col = ucwords($escapedFirstname)." ".ucwords($escapedLastname);

                    //inserção dos dados na base de dados
                    mysqli_query($conn, "INSERT INTO colaborador (col_name , col_email , col_password, col_effective, col_test) VALUES(
                    '" . mysqli_real_escape_string($conn, $nome_col) . "',
                    '" . mysqli_real_escape_string($conn, $escapedMail) . "',
                    '" . mysqli_real_escape_string($conn, $passwordHashed) . "',
                    '" . mysqli_real_escape_string($conn, $rookie) . "',
                    '0')") or die("<p class='text-white'>Error when creating the account: </p>" . mysqli_connect_error());

                    $para = $escapedMail; // Send email to our user
                    $assunto = 'Blue Infinity'; // Give the email a subject
                    $mensagem = '
 
                    Welcome Message:
                
                    ------------------------
                    Email: ' . $escapedMail . '
                    Password: ' . $escapedPassword . '
                    ------------------------
 
                    ';

                    $headers = 'From:noreply@blueinfinity.com'; // Nome de quem envia o link
                    mail($para, $assunto, $mensagem, $headers); // Envia o código

                    mysqli_close($conn);

                    print "<p class='text-white'>".$msg."</p>";
                }
            }
        }
    } else {
        //mensagem a imprimir caso o prenchimento dos dados ao inicio tenha sido inválido
        print "<p class='text-white'>Error filling the form</p>";
    }
}

?>