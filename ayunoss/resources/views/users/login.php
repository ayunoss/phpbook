<form action="<?php echo $generateUrl('login'); ?>" method="post">
    <h1>Sign up</h1>
    <p>
        <label for="username" class="u">Your username</label>
        <input type="text" name="login" id="login" placeholder="myname99" required="required"
               minlength="2" maxlength="90">
    </p>
    <p>
        <label for="passwordlogin" class="u">Your password</label>
        <input type="password" id="passwordlogin" name="passwordlogin" placeholder="mypassword99"
               required="required" maxlength="50">
    </p>
    <p>
        <b><button type="submit" class="btn btn-success">Sign up</button></b>
    </p>
    <p> Not a member yet ?
        <a href="<?php echo $generateUrl('signup') ?>" id="registration">Join us !</a>
    </p>
</form>