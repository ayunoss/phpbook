<form action="<?php echo $generateUrl('forgetPwd'); ?>" method="post" id="form">
    <h1>Password recovery </h1>
    <p>
        <label for="email" class="u">Your email address</label>
        <input type="text" id="email" name="email" placeholder="myemail@mail.com"
               required="required" maxlength="50">
    </p>
    <span class="error"></span>
    <p>
        <b><button type="submit" class="btn btn-success">Send recovery link</button></b>
    </p>
    <p> Already a member ?
        <a href="<?php echo $generateUrl('login') ?>" id="registration">Sign in !</a>
    </p>
    <p> Not a member yet?
        <a href="<?php echo $generateUrl('signup') ?>" id="registration">Join us!</a>
    </p>
</form>
<script src="/public/js/recoveryMail.js"></script>