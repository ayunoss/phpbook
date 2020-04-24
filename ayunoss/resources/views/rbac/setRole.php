<form action="<?php echo $generateUrl('setRole'); ?>" method="post">
    <p> Please select role
        <select size="1" name="selectRole">
            <option selected disabled>Choose role</option>
        <?php foreach ($data as $item) : ?>
            <option value="<?php echo $item['id']; ?>"><?php echo $item['role_name']; ?></option>
        <?php endforeach; ?>
        </select>
    </p>
    <p> Please select user id for this role
        <select size="1" name="selectUser_id">
            <option selected disabled>Choose user_id</option>
            <?php foreach ($data2 as $value) : ?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['id']; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <b><button type="submit" class="btn btn-success">Set role</button></b>
    </p>
    <p>
        <a href="<?php echo $generateUrl('roles'); ?>"> Roles list </a>
    </p>
</form>
