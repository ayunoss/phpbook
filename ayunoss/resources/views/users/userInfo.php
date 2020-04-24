<form action="http://ayunoss.phpbook/add-user-info/?id=<?php echo $_GET['id']; ?>" method="post" id="userinfoForm">
    <h1>Add your info</h1>
    <p>
        <label for="firstName" class="u">First name</label>
        <input type="text" name="firstName" id="firstName" placeholder="myfirstname" required="required"
               minlength="2" maxlength="50">
    </p>
    <p>
        <label for="lastName" class="u">Last name</label>
        <input type="text" id="lastName" name="lastName" placeholder="mylastname"
               required="required" maxlength="50">
    </p>
    <p>
        <label for="birthdate" class="u">Birthdate</label>
        <input type="date" name="birthdate" id="birthdate" required="required">
    </p>
    <p>
        <label for="address" class="u">Address</label>
        <input type="text" id="address" name="address" placeholder="myaddress99"
               maxlength="100">
    </p>
    <p>
        <label for="about" class="u">About yourself</label>
        <input type="text" id="about" name="about" placeholder="aboutmyself99"
               maxlength="500">
    </p>
    <p>
        <label for="links" class="u">Links</label>
        <input type="text" id="links" name="links" placeholder="google.com"
               maxlength="100">
    </p>
    <p>
        <b><button type="submit" class="btn btn-success">Upload info</button></b>
    </p>
</form>
<script src="/public/js/userinfo.js"></script>