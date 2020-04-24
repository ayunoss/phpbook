<form action="/register" method="post" id="signupForm">
    <h1>Sign up</h1>
    <p>
        <label for="username" class="u">Your username</label>
        <input type="text" name="username" id="login" placeholder="myname99" required="required"
               minlength="2" maxlength="90">
    </p>
    <p>
        <label for="phonenumsignup" class="u">Your phone number</label>
        <input type="text" name="phonenumber" id="phonenumsignup" placeholder="myphonenumber" required="required"
               minlength="5" maxlength="90"/>
    </p>
    <span class="emailError">
        <p>
        <label for="emailsignup" class="u">Your email</label>
        <input type="text" name="email" id="emailsignup" placeholder="myemail@mail.com"
               minlength="10"/>
        </p>
    </span>
    <p>
        <label for="passwordsignup" class="u">Your password</label>
        <input type="password" id="passwordsignup" name="passwordsignup" placeholder="mypassword99"
                   required="required" maxlength="50">
    </p>
    <span class="pwdError">
        <p>
            <label for="passwordsignup_confirm" class="u">Please confirm your password</label>
            <input type="password" id="passwordsignup_confirm" name="password_confirm"
                   placeholder="mypassword99" required="required" maxlength="50"/>
        </p>
    </span>
    <p>
        <b><button type="submit " id="signupButton" class="btn btn-success">Sign up</button></b>
    </p>
    <p> Already a member ?
        <a href="<?php echo $generateUrl('login') ?>" id="registration">Sign in !</a>
    </p>
</form>
<script src="/public/js/signup.js"></script>
