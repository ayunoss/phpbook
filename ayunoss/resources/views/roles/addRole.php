<form action="<?php echo $generateUrl('new-role'); ?>" method="post">
    <p>
        <label> Enter a name for the role :</label>
        <input type="text" id="role_name" name="role_name" required="required" placeholder=" RoleName ">
    </p>
    <p>
        <b><button type="submit" class="btn btn-success">Create</button></b>
    </p>
    <p>
        <a href="<?php echo $generateUrl('roles'); ?>">Roles list</a>
    </p>
</form>