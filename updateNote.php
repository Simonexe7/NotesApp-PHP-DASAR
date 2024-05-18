<?php
require_once 'templates/header.php';
require_once 'config.php';

$noteId = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM notes WHERE id = $noteId");
$note = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    $data = [];
    $data[] = htmlspecialchars(trim($_POST['title']));
    $data[] = htmlspecialchars(trim($_POST['tags']));
    $data[] = htmlspecialchars(trim($_POST['body']));
    $data[] = htmlspecialchars(trim($_POST['color']));

    $result = mysqli_query($conn, "UPDATE notes SET title = '$data[0]', tags = '$data[1]', body = '$data[2]', color = '$data[3]', updated_at = NOW() WHERE id = $noteId");
    if ($result) {
        header("location: index.php?status=success&message=updtsuccess");
    } else {
        header("location: index.php?status=failed&message=updtfailed");
    }
}

?>
<div class="container">
    <div class="title">
        <h1>Update Note</h1>
    </div>

    <form method="POST" id="noteForm">
        <div class="add-input">
            <input type="text" placeholder="Title" name="title" value="<?= $note['title']; ?>" required>
            <input type="text" placeholder="Tags" name="tags" value="<?= $note['tags']; ?>" required>
            <textarea type="text" placeholder="Body" name="body" required><?= $note['body']; ?></textarea>
            <input type="hidden" name="color" id="note_color" value="<?= $note['color']; ?>">
            <div class="colors">
                <div class="color red"></div>
                <div class="color blue"></div>
                <div class="color green"></div>
                <div class="color orange"></div>
            </div>
            <div class="action">
                <button class="btn btn_cancel">Cancel</button>
                <button type="submit" name="submit" class="btn btn_update">Update</button>
            </div>
        </div>
    </form>
</div>
<?php require_once 'templates/footer.php'; ?>