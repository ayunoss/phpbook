<form id="imgForm" method="post" action="" enctype="multipart/form-data">
    <div class="container">
        <h1>Here you can download pictures</h1>
    </div>
    <div class="container">
        <label>Choose images for downloading</label>
        <input class="form-img" id="image" type="file" name="image" multiple="multiple">
    </div>
    <div class="container">
        <input type="submit" class="btn btn-success">
    </div>
    <div id="errors" class="container">
        <?php ?>
    </div>
</form>