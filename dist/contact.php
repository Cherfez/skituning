<?php
// Message vars
$msg = '';
$msgClass = '';

// Check for Submit
 if(filter_has_var(INPUT_POST, 'submit')) {
     // Get Form Data
     $name = htmlspecialchars($_POST['name']);
     $email = htmlspecialchars($_POST['email']);
     $message = htmlspecialchars($_POST['message']);

     // Check Required Fields
     if(!empty($email) && !empty($name) && !empty($message)) {
        // Passed
        // Check Email
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            // Failed
            $msg = 'Ongeldig e-mail adres';
            $msgClass = 'alert-danger';
        } else {
            // Passed
            $toEmail = 'info@skituning.nl';
            $subject = 'Contact Request From '.$name;
            $body = '<h2>Contact Request</h2>
                <h4>Name</h4><p>'.$name.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>Message</h4><p>'.$message.'</p>
            ';

            // Email Headers
            $headers = "MIME-Version: 1.0" ."\r\n";
            $headers .="Content-Type:text/html;charset=UTF-8" ."\r\n";

            // Additional Headers
            $headers .= "From: " .$name. "<".$email.">". "\r\n";

            if(mail($toEmail, $subject, $body, $headers)) {
                // Email sent
                $msg = 'Uw email is verzonden!';
                $msgClass = 'alert-success';
            } else {
                // Failed
                $msg = 'Het lijkt erop dat er iets mis is gegaan. Probeer het later nogmaals. Excuses voor het ongemak.';
                $msgClass = 'alert-danger';
            }
        }
     } else {
        // Failed
        $msg = 'Please fill in all the fields';
        $msgClass = 'alert-danger';
     }
 }

?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Neem contact met ons op voor al uw vragen. Wij zorgen voor een spoedige en professionele afhandeling">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='style.css'>
    <script src="https://kit.fontawesome.com/46c93ff866.js"></script>


    <title>SKITUNING - Voor al het onderhoud van uw ski's en snowboard</title>
</head>

<body>
    <header id='jumbo-contact'>
        <div class="jumbotron jumbotron-fluid">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="index.html">
                    <img src='img/Skituning-logo-whitemountain.png' width="100" height="80" alt=''>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ml-auto mr-2 mt-2 mt-lg-0">
                        <li class="nav-item m-3">
                            <a class="nav-link" href="diensten.html">Diensten</a>
                        </li>
                        <li class="nav-item m-3">
                            <a class="nav-link" href="dropoff.html">Skituning Service Punt</a>
                        </li>
                        <li class="nav-item m-3">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class='container'>
                <h2>Betere prestaties in de sneeuw</h2>
                <p>Hot waxen, slijpen, polijsten van ski's en snowboard</p>
            </div>
        </div>
    </header>

    <main id='contact'>
        <div class='container'>
            <section class="mb-4">
                <h2 class="h1-responsive font-weight-bold text-center my-4">Neem contact met ons op</h2>
                <p class="text-center w-responsive mx-auto mb-5">Heeft u vragen? Neem gerust contact met ons op. Wij
                    komen zo snel mogelijk bij u terug.</p>

                <div class="row justify-content-center">
                    <div class="col-md-9 mb-md-0 mb-5">
                        <?php if($msg != ''): ?>
                        <div class='alert m-3 <?php echo $msgClass; ?>'>
                            <?php echo $msg; ?>
                        </div>
                        <?php endif; ?>
                        <form id="contact-form" name="contact-form" method="POST" action='<?php echo $_SERVER[' PHP_SELF']; ?>'>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="name" name="name" class="form-control mb-3" placeholder="Naam" value='<?php echo isset($_POST['name']) ? $name : '' ; ?>'>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="email" name="email" class="form-control mb-3" placeholder="E-mail"
                                value='<?php echo isset($_POST[' email']) ? $email : '' ; ?>'>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form">
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea mb-3"
                                placeholder="Uw bericht"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <button type='submit' name='submit' class='text-center text-md-left btn'>Verstuur</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="container-fluid footer">
        <div class='container'>
            <div class="row h-100">
                <div class="col-12 col-sm-5 mt-4">
                    <h5 class='mb-3'>Skituning</h5>
                    <p>
                        Voor al het onderhoud van uw ski's en snowboards. <br>
                        Perfection by hand.
                    </p>
                </div>
                <div class="col-12 col-sm-3 mt-0 mt-md-4">
                </div>
                <div class="col-12 col-sm-4 mt-4">
                    <h5 class='mb-3'>Contact</h5>
                    <p>
                        <a href='mailto:info@skituning.nl'><i class="fas fa-envelope"></i> info@skituning.nl </a>
                    </p>
                </div>
            </div>
        </div>
        <div class='row h-20 mt-md-2 mt-0'>
            <div class='col-12 privacy'><a href='privacy.html'>Privacyverklaring</a>
                | <a href='algemene.html'>Algemene
                    Voorwaarden</a></div>
            <div class='col-12 cher-fez'>&copy; 2019, <a href='https://www.cher-fez.com/' target='_blank'>Cher-Fez</a></div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>