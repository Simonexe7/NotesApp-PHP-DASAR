<?php
require_once 'templates/header.php';
require_once 'config.php';

if (isset($_POST["submit"])) {
    $data = array();
    $data[] = htmlspecialchars(trim($_POST["title"]));
    $data[] = htmlspecialchars(trim($_POST["tags"]));
    $data[] = htmlspecialchars(trim($_POST["body"]));

    mysqli_query($conn, "INSERT INTO notes(id, title, tags, body, created_at, updated_at) VALUES ('', '$data[0]', '$data[1]', '$data[2]', '', '')");
}
?>
<div class="container">
    <div class="title">
        <h1>Create Note</h1>
    </div>

    <form action="" method="POST">
        <div class="add-input">
            <input type="text" placeholder="Title" name="title">
            <input type="text" placeholder="Tags" name="tags">
            <textarea type="text" placeholder="Body" name="body"></textarea>
            <div class="action">
                <button class="btn btn_cancel">Cancel</button>
                <button type="submit" class="btn" name="submit">Create</button>
            </div>
        </div>
    </form>
</div>
<?php require_once 'templates/footer.php'; ?>