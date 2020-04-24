<form action="http://ayunoss.phpbook/upload-user-info/?id=<?php echo $_GET['id']; ?>" method="post" id="userinfoForm">
    <h1>Upload your info</h1>
    <p>
        <label for="firstName" class="u">First name</label>
        <input type="text" name="firstName" id="firstName"
               value="<?php echo htmlspecialchars($data['first_name']); ?>">
    </p>
    <p>
        <label for="lastName" class="u">Last name</label>
        <input type="text" id="lastName" name="lastName"
               value="<?php echo htmlspecialchars($data['last_name']); ?>">
    </p>
    <p>
        <label for="birthdate" class="u">Birthdate</label>
        <input type="date" name="birthdate" id="birthdate" value="<?php echo htmlspecialchars($data['birthdate']); ?>">
    </p>
    <p>
        <label for="address" class="u">Address</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($data['address']); ?>"
               maxlength="100">
    </p>
    <p>
        <label for="about" class="u">About yourself</label>
        <input type="text" id="about" name="about" value="<?php echo htmlspecialchars($data['about']); ?>"
               maxlength="500">
    </p>
    <p>
        <label for="links" class="u">Links</label>
        <input type="text" id="links" name="links" value="<?php echo htmlspecialchars($data['links']); ?>"
               maxlength="100">
    </p>
    <p>
        <b><button type="submit" class="btn btn-success">Upload info</button></b>
    </p>
</form>
<script src="/public/js/userinfo.js"></script>
