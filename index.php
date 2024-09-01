<?php 
// Functions to filter user inputs    
$field = "";
function filterEmail($field){
  // Sanitize e-mail address
  $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
  
  // Validate e-mail address
  if(filter_var($field, FILTER_VALIDATE_EMAIL)){
      return $field;
  } else{
      return FALSE; 
  }
}
function filterString($field){
  // Sanitize string
  $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
  if(!empty($field)){
      return $field;
  } else{
      return FALSE;
  }
}

// Define variables and initialize with empty values
$nameErr = $emailErr = $messageErr = "";
$name = $email = $message = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  // Validate email address
  if(empty($_POST["email"])){
      $emailErr = "Vul svp een geldig e-mail adres in";     
  } else{
      $email = filterEmail($_POST["email"]);
      if($email == FALSE){
          $emailErr = "Vul svp een geldig e-mail adres in";
      }
  }
  
  // Validate user comment
  if(empty($_POST["bericht"])){
      $messageErr = "Vul svp een bericht of vraag in";     
  } else{
      $message = filterString($_POST["bericht"]);
      if($message == FALSE){
          $messageErr = "Vul svp een bericht of vraag in";
      }
  }
  
  // Check input errors before sending email
  if(empty($nameErr) && empty($emailErr) && empty($messageErr)){
      // Recipient email address
      // this should be <username>@username.gc-webhosting.nl
      $to = 'net24yhuet@net24yhuet.gc-webhosting.nl';
      
      // Create email headers
      $headers = 'From: '. $email . "\r\n" .
      'Reply-To: '. $email . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
      
      // Sending email
      if(mail($to, $message, $headers)){
          echo '<p class="success">Je bericht is succesvol verzonden!</p>';
      } else{
          echo '<p class="error">Niet gelukt om te verzenden. Probeer svp opnieuw!</p>';
      }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- displays site properly based on user's device -->

  <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
  <link rel="stylesheet" href="style.css"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $('.container-succes').css("display", "none")

      $('.cardText button').on('click', function(){
        const email = $('#email').val()

        let regex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9]+$/;

        if (regex.test(email)) {
            $('.container').css("display", "none")
            $('.container-succes').css("display", "flex")
        } else {
            $('.validation').html("Valid email required").css("color", "hsl(4, 100%, 67%)")
            $('#email').css("background-color", "hsl(4, 100%, 67%)")
        }
      })

      $('.card-succes button').on('click', function(){
        $('.container-succes').css("display", "none")
        $('.container').css("display", "flex")
        $('#email').val("").css("background-color", "hsl(0, 0%, 100%)")
        $('#bericht').val("")
        $('.validation').html("")
      })
    })
  </script>
  <title>Frontend Mentor | Newsletter sign-up form with success message</title>
<body>

  <div class="container">
    <div class="cardText">
      <h1>Stay updated!</h1>
      <p class="pText">Join 60,000+ product managers receiving monthly updates on:</p>
      <ul>
        <li><span></span><p>Product discovery and building what matters</p></li>
        <li><span></span><p>Measuring to ensure updates are a success</p></li>
        <li><span></span><p>And much more!</p></li>
      </ul>
      <div class="cardEmail">
        <div class="emailValidation">
          <p class="pEmail">Email address</p>
          <p class="validation"></p>
        </div>
        <input type="text" name="email" id="email" placeholder="email@company.com">
        <textarea name="bericht" id="bericht" placeholder="voer hier tekst in"></textarea>
      </div>
      <button type="submit">Subscribe to monthly newsletter</button>
    </div>
    <div class="cardImage">

    </div>
  </div>
  <div class="container-succes">
    <div class="card-succes">
      <div class="image-succes">

      </div>
      <h1>Thanks for subscribing!</h1>
      <p>A confirmation email has been sent to ash@loremcompany.com. 
         Please open it and click the button inside to confirm your subscription.</p>
      <button type="succes">Dismiss message</button>
    </div>
  </div>

  <!-- Sign-up form start -->

  <!-- Stay updated!

  Join 60,000+ product managers receiving monthly updates on:

  Product discovery and building what matters
  Measuring to ensure updates are a success
  And much more!

  Email address
  email@company.com

  Subscribe to monthly newsletter -->

  <!-- Sign-up form end -->

  <!-- Success message start -->

  <!-- Thanks for subscribing!

  A confirmation email has been sent to ash@loremcompany.com. 
  Please open it and click the button inside to confirm your subscription.

  Dismiss message -->

  <!-- Success message end -->
  
  <div class="attribution">
    Challenge by <a href="https://www.frontendmentor.io?ref=challenge" target="_blank">Frontend Mentor</a>. 
    Coded by <a href="#">Yannick van Huet</a>.
  </div>
</body>
</html>