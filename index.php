<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacker Poulette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="/assets/style.css" rel="stylesheet">
    <style>
        .error { color: red; }
    </style>
</head>
<body>
<nav class="navbar bg-body-tertiary" data-bs-theme="light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="img/hackers-poulette-logo.png" alt="Logo" width="150" height="100" class="d-inline-block align-text-top">
      <p class="mt-2">Hackers-poulette</p>
    </a>
  </div>
</nav>

<?php
// Inizializzazione delle variabili di errore
$fname_error = $lname_error = $email_error = $gender_error = $country_error = $subject_error = $message_error = "";

function sanitize_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}

// Controlla se il form è stato inviato
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    $fname = sanitize_input($_POST['fname']);
    $lname = sanitize_input($_POST['lname']);
    $email = sanitize_input($_POST['email']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $subject = sanitize_input($_POST['subject']);
    $message = sanitize_input($_POST['message']);

    $has_error = false;

    if (empty($fname)) {
        $fname_error = 'First name is required.';
        $has_error = true;
    }
    if (empty($lname)) {
        $lname_error = 'Last name is required.';
        $has_error = true;
    }
    if (empty($email)) {
        $email_error = 'Email is required.';
        $has_error = true;
    }
    if (empty($gender)) {
        $gender_error = 'Gender is required.';
        $has_error = true;
    }
    if (empty($country)) {
        $country_error = 'Country is required.';
        $has_error = true;
    }
    if (empty($subject)) {
        $subject_error = 'Subject is required.';
        $has_error = true;
    }
    if (empty($message)) {
        $message_error = 'Message is required.';
        $has_error = true;
    }

    if (!$has_error) {
        require "phpmailer/src/Exception.php";
        require "phpmailer/src/PHPMailer.php";
        require "phpmailer/src/SMTP.php";

        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = ""; // Modifica con il tuo indirizzo email
        $mail->Password = ""; // Modifica con la tua password
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        $mail->setFrom("shavuk97@gmail.com"); // Modifica con il tuo indirizzo email
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) {
            echo "<script>alert('Email sent successfully!')</script>";
            // Reindirizza o mostra un messaggio di successo
        } else {
            echo "<script>alert('Failed to send email.')</script>";
        }
    }
}
?>

<main id="container" class="container my-5 text-center shadow-lg p-3 mb-5 bg-body-tertiary rounded" style = "max-width: 580px">
<form method="post" action="" autocomplete="off">
    <label class="form-label mt-n1" for="fname">First name:</label>
    <input class="form-control border border-info mt-n1" type="text" id="fname" name="fname" value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>"><br><br>
    <p class="error error_fname"><?php echo $fname_error; ?></p>

    <label class="form-label" for="lname">Last name:</label>
    <input class="form-control border border-info" type="text" id="lname" name="lname" value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>"><br><br>
    <p class="error error_lname"><?php echo $lname_error; ?></p>

    <label class="form-label" for="email">Email:</label>
    <input class="form-control border border-info" type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"><br><br>
    <p class="error error_email"><?php echo $email_error; ?></p>
    <div>
    <label>Select your gender:</label>
    <input class="btn-check" type="radio" name="gender" value="male" id="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'male') ? 'checked' : ''; ?>>
    <label class="btn btn-primary" for="male">Male</label>
    <input class="btn-check" type="radio" name="gender" value="female" id="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'female') ? 'checked' : ''; ?>>
    <label class="btn btn-primary" for="female">Female</label>
    <input class="btn-check" type="radio" name="gender" value="other" id="other" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'other') ? 'checked' : ''; ?>>
    <label class="btn btn-primary" for="other">Other</label><br><br>
    <p class="error error_gender"><?php echo $gender_error; ?></p>
    </div>
    <div>
    <label for="country">Choose a Country:</label>
    <select class="form-selec border border-info" name="country" id="country">
        <option value="">Select a country</option>
        <option value="Italy" <?php echo (isset($_POST['country']) && $_POST['country'] == 'Italy') ? 'selected' : ''; ?>>Italy</option>
        <option value="Belgium" <?php echo (isset($_POST['country']) && $_POST['country'] == 'Belgium') ? 'selected' : ''; ?>>Belgium</option>
        <option value="Spain" <?php echo (isset($_POST['country']) && $_POST['country'] == 'Spain') ? 'selected' : ''; ?>>Spain</option>
        <option value="France" <?php echo (isset($_POST['country']) && $_POST['country'] == 'France') ? 'selected' : ''; ?>>France</option>
    </select><br><br>
    <p class="error error_country"><?php echo $country_error; ?></p>
    </div>
    <div>
    <label for="subject">Choose a subject:</label>
    <select class="form-select border border-info" name="subject" id="subject">
        <option value="">Select a subject</option>
        <option value="learning" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'learning') ? 'selected' : ''; ?>>Learning</option>
        <option value="gaming" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'gaming') ? 'selected' : ''; ?>>Gaming</option>
        <option value="other" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'other') ? 'selected' : ''; ?>>Other</option>
    </select><br><br>
    <p class="error error_subject"><?php echo $subject_error; ?></p>
    </div>
<div class="mb-3">
    <label class="form-label" for="message">Enter a Message:</label>
    <textarea class="form-control border border-info" id="message" name="message"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea><br><br>
    <p class="error error_message"><?php echo $message_error; ?></p>
</div>
    <input class="btn btn-success mb-n1" type="submit" value="Submit">
</form>
</main>
</body>
</html>
