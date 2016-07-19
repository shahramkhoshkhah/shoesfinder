<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
    $category = trim(filter_input(INPUT_POST,"category",FILTER_SANITIZE_STRING));
    $title = trim(filter_input(INPUT_POST,"title",FILTER_SANITIZE_STRING));
    $color = trim(filter_input(INPUT_POST,"color",FILTER_SANITIZE_STRING));
    $size= trim(filter_input(INPUT_POST,"size",FILTER_SANITIZE_STRING));
    $price = trim(filter_input(INPUT_POST,"price",FILTER_SANITIZE_STRING));
    $details = trim(filter_input(INPUT_POST,"details",FILTER_SANITIZE_SPECIAL_CHARS));
    if ($name == "" || $email == "" || $category == "" || $title == "") {
        $error_message = "please fill in the required fields: Name, Email, Category and Title";
    }
    if (!isset($error_message) && $_POST["address"] != "") {
        $error_message ="Bad form input";
    }
    require("inc/phpmailer/class.phpmailer.php");
    $mail = new PHPMailer;
    if (!isset($error_message) && !$mail->ValidateAddress($email)) {
         $error_message = "Invalid Email Address";
    }
    if (!isset($error_message)) {
        $email_body = "";
        $email_body .=  "Name " . $name . "\n";
        $email_body .=  "Email " . $email ."\n";
        $email_body .=  "Suggested Item\n";
        $email_body .=  "Category " . $category . "\n";
        $email_body .=  "Title " . $title . "\n";
        $email_body .=  "Color " . $color . "\n";
        $email_body .=  "Size " . $size . "\n";
        $email_body .=  "Price " . $price . "\n";
        $email_body .=  "Details " . $details . "\n";
        $mail->setFrom($email, $name);
        $mail->addAddress('shahram_khoshkhah@yahoo.com.au', 'Shawn');
        $mail->isHTML(false);
        $mail->Subject = 'Shosefinder suggestion from ' . $name;
        $mail->Body  = $email_body;
        if($mail->send()) {
            header("location:suggest.php?status=thanks");
            exit;
         }
         $error_message ='Message could not be sent.';
         $error_message .= 'Miler Error: ' . $mail->ErrorInfo;
     }
}
$pageTitle = "Suggest a Shoes style";
$section = "suggest";
//include("inc/header.php");
?>

<div class="section page">
    <div class="wrapper">
        <h1>Suggest a Shoes style</h1>
        <?php if (isset($_GET["status"]) && $_GET["status"] == "thanks") {
             echo "<p>Thanks for the email! I&rsquo;ll check out your suggestion shortly!</p>";
        } else {
            if (isset($error_message)) {
                echo "<p class='message'>" .$error_message . "</p>";
            } else {
                 echo "<p>If you think there is something I&rsquo;m missing, let me know! Complete the form to send me an email.</p>";
            }
        ?>
        <form method="post" action="suggest.php">
            <table>
            <tr>
                <th><label for="name">Name (required)</label></th>
                <td><input type="text" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>" /></td>
            </tr>
            <tr>
                <th><label for="email">Email (required)</label></th>
                <td><input type="text" id="email" name="email" value="<?php if (isset($email)) { echo $email; } ?>" /></td>
            </tr>
            <tr>
                <th><label for="category">Category (required)</label></th>
                <td><select id="category"  name="category" >
                    <option value="">Select One</option>
                    <option value="Women"<?php if (isset($category) && $category == "Women") { echo " selected"; } ?>>Women</option>
                    <option value="Men" <?php if (isset($category) && $category == "Men") { echo " selected"; } ?>>Men</option>
                    <option value="Kids" <?php if (isset($category) && $category == "Kids") { echo " selected"; } ?>>Kids</option>
                </select></td>
            </tr>
            <tr>
            <tr>
              <th><label for="title">Title (required)</label></th>
              <td><input type="text" id="title" name="title" value="<?php if (isset($title)) { echo $title; } ?>" /></td>
           </tr>

            <tr>
                <th><label for="color">Color</label></th>
                <td><select id="color"  name="color" >
                    <option value="">Select One</option>
                    <option value="Black">Black</option>
                    <option value="Brown">Brown</option>
                    <option value="White">White</option>
                    <option value="Blue">Blue</option>
                    <option value="Red">Red</option>
                </select></td>
            </tr>
            <tr>
                <th><label for="size">Size</label></th>
                <td><select id="size"  name="size" >
                    <option value="">Select One</option>
                    <option value="Xs">Xs</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                </select></td>
            </tr>
            <tr>
                <th><lable for="price">Price</lable></th>
                <td><input type="text" id="price" name="price" value="<?php if (isset($price)) { echo $price; } ?>" /></td>
            </tr>
            <tr>
                <th><label for="name">Suggest Item Details</label></th>
                <td><textarea name="details" id="details"><?php if (isset($details)) { echo htmlspecialchars($_POST["details"]); } ?></textarea></td>
            </tr>
            <tr style="display:none">
                <th><label for="address">Address</label></th>
                <td><input type="text" id="address" name="address" />
                <p>please leave this field blank</p></td>
            </tr>
            </table>
            <input type="submit" value="Send" />
        </form>
        <?php } ?>
    </div>
</div>

<?//php include("inc/footer.php");
?>
