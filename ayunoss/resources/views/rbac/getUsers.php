<table border="1">
    <tr>
        <th> </th>
        <th> user_id </th>
        <th> login </th>
        <th> email </th>
        <th> phone number </th>
        <th> role </th>
        <th> permissions </th>
    </tr>
    <?php foreach ($data as $item) : ?>
    <tr>
        <td>
            <a href="http://ayunoss.phpbook/upload-user-info/?id=<?php echo $item['id']; ?>"><i class="fas fa-user-edit"></i></a>
            <a href="http://ayunoss.phpbook/delete-user/?id=<?php echo $item['id']; ?>"><i class="fas fa-user-times"></i></a>
        </td>
        <td><?php echo $item['id']; ?></td>
        <td><?php echo $item['login']; ?></td>
        <td><?php echo $item['email']; ?></td>
        <td><?php echo $item['phone']; ?></td>
        <?php foreach ($data2 as $val) : ?>
        <?php if($item['id'] === $val['user_id']) : ?>
        <td><?php echo $val['role_name'] ?></td>
        <td><?php echo $val['perm_name']?></td>
        <?php endif; ?>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>
<p>
    <a href="<?php echo $generateUrl('setRole'); ?>">Set user role</a>
</p>