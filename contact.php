<?php
// Enable error reporting while testing
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['Name']));
    $email = filter_var(trim($_POST['Email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['Message']));

    // Email settings
    $to = "contact@kandjeducation.com";
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email\r\nReply-To: $email";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        header("Location: thank-you.html");
        exit();
    } else {
        echo "Error: Unable to send email. Server might not allow PHP mail().";
    }
}
?>

<!-- HTML form -->
<section class="contact section" id="contact">
  <h2 class="section-title">Contact</h2>
  <div class="contact__container bd-grid">
    <form action="contact.php" method="POST" class="contact__form">
      <input type="hidden" name="_captcha" value="false">
      <input type="hidden" name="_next" value="https://yourwebsite.com/thank-you.html">

      <input type="text" name="Name" placeholder="Name" class="contact__input" required>
      <input type="email" name="Email" placeholder="Email" class="contact__input" required>
      <textarea name="Message" placeholder="Your Message" rows="10" class="contact__input" required></textarea>

      <input type="submit" value="Send" class="contact__button button">
    </form>
  </div>
</section>
