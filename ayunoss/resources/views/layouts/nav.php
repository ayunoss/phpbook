<a class="active" href="/">Home</a>
<?php if (isset($_SESSION['logged_in'])) : ?>
    <a href="<?php echo $generateUrl('logout'); ?>">Logout</a>
    <a href="<?php echo $generateUrl('account'); ?>"><?php echo $_SESSION['username']; ?></a>
<?php else :?>
    <a href="<?php echo $generateUrl('login'); ?>">Login</a>
    <a href="<?php echo $generateUrl('signup'); ?>">Sign up</a>
<?php endif; ?>