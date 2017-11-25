<?php
//Ligação à base de dados
$servername = "localhost";
$username = "root";
$password = "";
$bd = "Projeto_Si";
$conn = mysqli_connect($servername, $username, $password, $bd);
if (!$conn) {
    die("Erro na ligacao: " . mysqli_connect_error()); //Mensagem de erro caso nao haja ligação à base de dados
    //Caso haja ligação executa o código abaixo!vv
}


//Verifica se o botão de registo já foi carregado ou não
if (isset($_POST['signup_submit'])) {

    //Verifica se todos os campos do formulário foram preenchidos e não estão vazios
    if ((isset($_POST['nome']) && !empty($_POST['nome'])) && (isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
        $escapedNome = mysqli_real_escape_string($conn, $_POST['nome']);
        $escapedMail = mysqli_real_escape_string($conn, $_POST['email']);
        $escapedPassword = mysqli_real_escape_string($conn, $_POST['password']);

        //Verifica se o email já existe na base de dados
        $resultados = mysqli_query($conn, "select email from clients where (email='$escapedMail');");
        if (mysqli_num_rows($resultados) > 0) {
            $linha = mysqli_fetch_assoc($resultados);
            if ($escapedMail == $linha['email']) {
                print "Email já existente!";
            }
            //caso o mail nao existir corre o codigo abaixo
        } else {
            //verifica se o mail é valido e está bem escrito
            if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $escapedMail)) {
                $msg = 'Email inválido, por favor tente de novo';
            } else {
                $msg = 'Conta criada, <br /> por favor verifique a sua conta através do link que enviamos para o seu email.';

                $hash = md5(rand(0, 1000));
                $passwordHashed = password_hash($escapedPassword, PASSWORD_DEFAULT);

                //inserção dos dados na base de dados
                mysqli_query($conn, "INSERT INTO colaboradores (name , email , password , hash, balance) VALUES(
            '" . mysqli_real_escape_string($conn, ucwords($escapedNome)) . "',
            '" . mysqli_real_escape_string($conn, $escapedMail) . "',
            '" . mysqli_real_escape_string($conn, $passwordHashed) . "',
            '" . mysqli_real_escape_string($conn, $hash) . "',
            '" . mysqli_real_escape_string($conn, $balance) . "')") or die("Erro na criação de conta: " . mysqli_connect_error());

                $para = $escapedMail; // Send email to our user
                $assunto = 'Blue Infinity'; // Give the email a subject
                $mensagem = '
 
                Mensagem de boas vindas:
                
                ------------------------
                Email: ' . $escapedMail . '
                Password: ' . $escapedPassword . '
                ------------------------
 
                ';

                $headers = 'From:noreply@blueinfinity.com'; // Nome de quem envia o link
                mail($para, $assunto, $mensagem, $headers); // Envia o código

                mysqli_close($conn);
            }
        }

    } else {
        //mensagem a imprimir caso o prenchimento dos dados ao inicio tenha sido inválido
        print "erro a preencher o formulário";
    }

    print "<script type='text/javascript'>
            $(document).ready(function(){
                $('#signupModal').modal('show');
             });
          </script>";

}

if (isset($msg)) {
    print "<h3>" . $msg . "</h3>";
}


?>