<?php require_once 'templates/header.php'; ?>
<div class="container">
    <div class="title">
        <h1>Update Note</h1>
    </div>

    <form action="">
        <div class="add-input">
            <input type="text" placeholder="Title">
            <input type="text" placeholder="Tags">
            <textarea type="text" placeholder="Body"></textarea>
            <div class="action">
                <button class="btn btn_cancel">Cancel</button>
                <button type="submit" class="btn">Update</button>
            </div>
        </div>
    </form>
</div>
<?php require_once 'templates/footer.php'; ?>