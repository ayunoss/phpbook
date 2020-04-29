<form action="<?php echo $generateUrl('resetPwd'); ?>" method="post" id="form">
    <h1>Password recovery </h1>
    <p>
        <label for="newpwd" class="u">Your new password</label>
        <input type="password" id="newpwd" name="newpwd" placeholder="myPasSW0rd09"
               required="required" maxlength="50">
    </p>
    <p>
        <label for="newpwd_confirm" class="u">Confirm your new password</label>
        <input type="password" id="newpwd_confirm" name="newpwd_confirm" placeholder="myPasSW0rd09"
               required="required" maxlength="50">
    </p>
    <span class="error"></span>
    <p>
        <b><button type="submit" class="btn btn-success">Reset password</button></b>
    </p>
</form>
<script src="/public/js/recoveryPwd.js"></script>