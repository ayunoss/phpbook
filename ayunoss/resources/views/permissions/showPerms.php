<table border="1">
    <tr>
        <th> perm_id </th>
        <th> perm_name </th>
    </tr>
    <?php foreach ($data as $item) : ?>
        <tr>
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['perm_name']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br/>
<form action="http://ayunoss.phpbook/root/permissions" method="post">
    <p>
        <label> Enter permission :</label>
        <input type="text" id="perm_name" name="perm_name" required="required" placeholder=" PermissionName ">
    </p>
    <p>
        <b><button type="submit" class="btn btn-success">Create</button></b>
    </p>
    <p>
        <a href="http://ayunoss.phpbook/root/roles">Roles list</a>
    </p>
</form>