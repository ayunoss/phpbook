<table border="1">
    <tr>
        <th> role_id </th>
        <th> role_name </th>
        <th> permissions </th>
    </tr>
<?php foreach ($data as $item) : ?>
    <tr>
    <td><?php echo $item['id']; ?></td>
    <td><?php echo $item['role_name']; ?></td>
        <?php foreach ($data2 as $value) :?>
        <?php if($item['role_name'] === $value['role_name']) :?>
    <td><?php echo $value['perm_name']; ?></td>
        <?php endif; ?>
        <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
</table>
<p>
    <a href="<?php echo $generateUrl('setPermissions'); ?>"> Set permissions to role </a>
    <a href="<?php echo $generateUrl('new-role'); ?>"> Add new role </a>
</p>
