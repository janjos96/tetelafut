<?php
//Ligação à base de dados
$servername = "localhost";
$username = "root";
$password = "";
$bd = "tetelafut";
$conn = mysqli_connect($servername, $username, $password, $bd);
if (!$conn) {
    die("Erro na ligacao: " . mysqli_connect_error());
}


if(isset($_POST['login_submit'])){
    
    
    if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
        $escapedMail = mysqli_real_escape_string($conn, $_POST['email']);
        $escapedPassword = mysqli_real_escape_string($conn, $_POST['password']);


        //Verifica na base de dados se o email existe
        $resultados_col = mysqli_query($conn, "select col_email, col_password from colaborador where col_email='$escapedMail';");
        $resultados_admin = mysqli_query($conn, "select admin_email, admin_password from admin where admin_email='$escapedMail';");
        if (mysqli_num_rows($resultados_col) > 0 && mysqli_num_rows($resultados_admin) == 0) {
            $linha_col = mysqli_fetch_assoc($resultados_col);
            if ($escapedMail === $linha_col['col_email']) {
                //verifica se a password da conta está correta
                if (/*password_verify($escapedPassword, $linha_col['col_password'])*/ $escapedPassword == $linha_col['col_password']) {
                    $resultados = mysqli_query($conn, "select * from colaborador where col_email='$escapedMail';");
                    $linha_col = mysqli_fetch_assoc($resultados);
                    $_SESSION['loggedin'] = true;
                    $_SESSION['admin'] = false;
                    $_SESSION['name'] = $linha_col['col_name'];
                    header("Location: index.php");
                    exit;
                } else {
                    print "Password incorreta!";
                }
            }

        } else if (mysqli_num_rows($resultados_col) == 0 && mysqli_num_rows($resultados_admin) > 0) {

            $linha_admin = mysqli_fetch_assoc($resultados_admin);
            if ($escapedMail === $linha_admin['admin_email']) {
                //verifica se a password da conta está correta
                if ($escapedPassword == $linha_admin['admin_password']) {
                    $resultados2 = mysqli_query($conn, "select * from admin where admin_email='$escapedMail';");
                    $linha_admin = mysqli_fetch_assoc($resultados_admin);
                    $_SESSION['loggedin'] = true;
                    $_SESSION['admin'] = true;
                    $_SESSION['name'] = $linha_admin['admin_name'];
                    header("Location: index.php");
                    exit;
                } else {
                    print "Password incorreta!";
                }
            }

        } else {
            print "Erro ao efetuar o login. Por favor registe-se ou confirme a sua conta.";
        }

    } else {
        //mensagem a imprimir caso o prenchimento dos dados ao inicio tenha sido inválido
        echo "Erro a preencher o formulário";
    }
}

?>