<?php
require_once 'templates/header.php';
require_once 'functions.php';

// mengambil note berdasarkan id
$noteId = $_GET['id'];
$note = getNoteById($noteId);

// mengumpulkan data form ketika tombol submit ditekan
if (isset($_POST["submit"])) {
    $data = array();
    $data[] = htmlspecialchars(trim($_POST['title']));
    $data[] = htmlspecialchars(trim($_POST['tags']));
    $data[] = htmlspecialchars(trim($_POST['body']));
    $data[] = htmlspecialchars(trim($_POST['color']));

    // menjalankan fungsi mengubah note
    updateNote($noteId, $data);
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
                <button type="button" class="btn" onclick="direct()">Cancel</button>
                <button type="submit" name="submit" class="btn btn_update">Update</button>
            </div>
        </div>
    </form>
</div>
<?php require_once 'templates/footer.php'; ?>