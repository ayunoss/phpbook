<form action="<?php echo $generateUrl('feedback'); ?>" method="post" id="form">
    <h1>You can leave your feedback here</h1>
    <p>
        <label for="name" class="u">Your name</label>
        <input type="text" name="name" id="name" placeholder="myname99" required="required"
               minlength="2" maxlength="90">
    </p>
    <p>
        <label for="phonenumber" class="u">Your phone number</label>
        <input type="text" name="phonenumber" id="phonenumber" value="+" required="required"
               minlength="5" maxlength="90"/>
    </p>
    <span class="emailError">
        <p>
        <label for="email" class="u">Your email</label>
        <input type="text" name="email" id="email" placeholder="myemail@mail.com"
               minlength="10"/>
        </p>
    </span>
    <p>
        <label for="feedback" class="u">Leave us a message</label>
        <textarea name="feedback" id="feedback" required="required" minlength="5" maxlength="90"
                  placeholder="Your feedback here"></textarea>
    </p>
    <p>
        <b><button type="button" id="button" class="btn btn-success">Send</button></b>
    </p>
</form>
<script src="/public/js/feedback.js"></script>
