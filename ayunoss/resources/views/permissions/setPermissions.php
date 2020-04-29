<form action="<?php echo $generateUrl('setPermissions'); ?>" method="post">
    <p> <b>Please select the role to assign permissions</b>
        <select class="form-control" name="chooseRole">
            <option selected disabled>Choose role</option>
            <?php foreach ($data as $item) : ?>
                <option value="<?php echo $item['id']; ?>"><?php echo $item['role_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p> <b>Please select permissions for the role</b>
        <select class="form-control" name="setPermission[]" multiple>
            <option selected disabled>Choose permission</option>
            <?php foreach ($data2 as $value) : ?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['perm_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <b><button type="submit" class="btn btn-success">Set permission</button></b>
    </p>
    <p>
        <a href="<?php echo $generateUrl('roles'); ?>"> Roles list </a>
    </p>
</form>