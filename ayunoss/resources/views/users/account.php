<p>Username: <?php echo $data['login']; ?></p>
<p>First name: <?php
    if(array_key_exists('first_name', $data)) {
    echo $data['first_name'];
    } else echo "Please upload your information" ;?>
</p>
<p>Last name: <?php
    if(array_key_exists('last_name', $data)) {
        echo $data['last_name'];
    } else echo "Please upload your information" ;?>
</p>
<p>Birthdate:<?php
    if(array_key_exists('birthdate', $data)) {
        echo $data['birthdate'];
    } else echo "Please upload your information" ;?>
</p>
<p>Email: <?php echo $data['email'];?></p>
<p>Phone number: <?php echo $data['phone'];?></p>
<p>Address: <?php
    if(array_key_exists('address', $data)) {
        echo $data['address'];
    } else echo "Please upload your information" ;?>
</p>
<p>About yourself: <?php
    if(array_key_exists('about', $data)) {
        echo $data['about'];
    } else echo "Please upload your information" ;?>
</p>
<p>Links: <?php
    if(array_key_exists('links', $data)) {
        echo $data['links'];
    } else echo "Please upload your information" ;?></p>
<?php if(!array_key_exists('links', $data)) : ?>
<p><a href="http://ayunoss.phpbook/add-user-info/?id=<?php echo $data['id']; ?>">Add personal information</a></p>
<?php else : ?>
<p><a href="http://ayunoss.phpbook/upload-user-info/?id=<?php echo $data['id']; ?>">Upload personal information</a></p>
<?php endif; ?>