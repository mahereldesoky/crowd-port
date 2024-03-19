<?php
$Name = "";
$Email = "";
$subject = "";
$message = ""; //first we leave email field blank
if (isset($_POST['contact'])) { //if subscribe btn clicked
    $firstName = $_POST['name'];
    $userEmail = $_POST['email']; //getting user entered email
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $new_message = filter_var($message, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    if (filter_var($message)) { //validating user message
        $to = "maherfared@gmail.com";
        $subject = "Message From maherfared Website";
        $txt = "Customer Name: " . $Name . "\r\n Email : " . $Email .
            "\r\n subject: " . $subject . "\r\n Message : " . $new_message;
        $headers = "From: noreply@maherfared.com" . "\r\n" .
            "CC: ";                        //php function to send mail
        if (mail($to, $subject, $txt, $headers)) {
?>
            <!-- show sucess message once email send successfully -->
            <script>
                const sucssess = Swal.mixin({
                    sucssess: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (sucssess) => {
                        sucssess.addEventListener('mouseenter', Swal.stopTimer)
                        sucssess.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                sucssess.fire({
                    icon: 'success',
                    title: 'Thank You Message Sent Successfully !'
                })
            </script>
        <?php
            $userEmail = "";
        } else {
        ?>
            <!-- show error message if somehow mail can't be sent -->
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Something Went wrong'
                })
            </script>
        <?php
        }
    } else {
        ?>
        <!-- show error message if user entered email is not valid -->
        <div class="alert alert-danger">
            <?php echo "$userEmail is not a valid email address!" ?>
        </div>
<?php
    }
}
?>