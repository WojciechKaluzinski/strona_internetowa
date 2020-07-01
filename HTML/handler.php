<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kontakt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="StronaGlowna.css"/>
    <script type="text/javascript" src="/JS/StronaGlowna_Header.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <img src="logo.jpg" width="180" height="70" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link hov" href="index.html">Strona Główna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link hov" href="OMnie.html">O mnie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link hov" href="Oferta.html">Oferta</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Kontakt
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
            <a class="navbar-brand" href="#">
                <i class="fa fa-facebook-f" style="font-size:36px; color: honeydew"></i>
            </a>
        </div>

    </div>

</nav>

<?php
if (isset($_POST['Email'])) {
    $send = True;
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "profesorprzecinek1@gmail.com";
    $email_subject = "Wiadomość ze strony: AUTO-RZECZOZNAWCA.PL";

    function problem($error)
    {
        ?>
        <div class="container">
            <div class="row">
                <img src="contact.jpg" id="ofer-img">
            </div>
            <div class="row ">
                <div class="col-12 text-center">
                     <?php
                        echo "<h5>Niestety wiadomość nie została wysłana, ponieważ pojawiły się błędy: <br><br></h5>";
                        echo $error . "<br><br>";
                        echo "Aby wysłać wiadomość musisz wrócić i poprawić powyższe błędy.<br><br>";
                    ?>
                    <img src="broken-car.jpg" style="width: 400px; height: auto;">
                </div>
            </div>
        </div>
        <?php
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Phone']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Niestety wiadomość nie została wysłana, ponieważ pojawiły się błędy: ');
    }

    $name = $_POST['Name']; // required
    $phone = $_POST['Phone']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $phone_exp = '/^[0-9]{9}$/';

    if (!preg_match($phone_exp, $phone)) {
        $error_message .= 'Podany numer telefonu wydaje się być nieprawidłowy.<br>';
    }

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Podany adres e-mail wydaje się być nieprawidłowy.<br>';
    }

    $string_exp = "/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Podane imię wydaje się być nieprawidłowe.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Napisana wiadomość wydaje się być nieprawidłowa.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
        $send = False;
    }

    $email_message = "Szczegóły formularza poniżej.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Imię: " . clean_string($name) . "\n";
    $email_message .= "Telefon: " . clean_string($phone) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Wiadomość: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    if($send == True){
        @mail($email_to, $email_subject, $email_message, $headers);
        ?>
        <div class="container">
            <div class="row">
                <img src="contact.jpg" id="ofer-img">
            </div>
            <div class="row ">
                <div class="col-12 text-center">
                    <h5>Dziękuję Ci za wiadomość. Wkrótce się z Tobą skontaktuję.</h5>
                    <a href="index.html" class="btn btn-primary btn-lg" id="contact-button">Powrót do strony głównej</a>
                </div>
            </div>
        </div>
        <?php
    }
}
?>


<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-6">
                    <div class="navbar-brand">
                        <img src="logo2.jpg" alt="">
                    </div>
                    <p> mgr inż. Krzysztof Loda - </p>
                    <p> Certyfikowany Rzeczoznawca Samochodowy </p>
                    <p> z listy Ministra Infrastruktury i Rozwoju nr RS 001235</p>
                </div>
                <div class="col-lg-3 col-md-8 col-sm-8 col-xs-3">
                    <ul>
                        <li><a class="email" href="mailto: rzeczoznawca.loda@gmail.com">
                            rzeczoznawca.loda@gmail.com </a></li>
                        <br/>
                        <li><p> tel.: +48 692 000 274 </p></li>
                    </ul>
                </div>
                <div class="text-lg-center col-lg-3 col-md-8 col-sm-8 col-xs-3">
                    <ul>
                         <li><h5><a href="index.html" style="margin-top: 5em"> Strona Główna </a></h5></li>
                         <li><h5><a href="OMnie.html"> O mnie </a></h5></li>
                         <li><h5><a href="Oferta.html"> Oferta </a></h5></li>
                   </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <p class="pull-left copyright"> BIURO USŁUG MOTORYZACYJNYCH „RZECZOZNAWCA SAMOCHODOWY”
                        2020 </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer -->
</body>
</html>



