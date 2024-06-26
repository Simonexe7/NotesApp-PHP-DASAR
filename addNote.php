<?php
require_once 'templates/header.php';
require_once 'functions.php';

// mengumpulkan data form
if (isset($_POST["submit"])) {
    $data = array();
    $data[] = htmlspecialchars(trim($_POST["title"]));
    $data[] = htmlspecialchars(trim($_POST["tags"]));
    $data[] = htmlspecialchars(trim($_POST["body"]));
    $data[] = $_POST["color"];

    // menjalankan fungsi tambah note
    createNote($data);
}
?>
<div class="container">
    <div class="title">
        <h1>Create Note</h1>
    </div>

    <!-- form -->
    <form method="POST" id="noteForm">
        <div class="add-input">
            <input type="text" placeholder="Title" name="title" required>
            <input type="text" placeholder="Tags" name="tags" required>
            <textarea type="text" placeholder="Body" name="body" required></textarea>
            <input type="hidden" name="color" id="note_color">
            <div class="colors">
                <div class="color red"></div>
                <div class="color blue"></div>
                <div class="color green"></div>
                <div class="color orange"></div>
            </div>
            <div class="action">
                <button type="button" class="btn" onclick="direct()">Cancel</button>
                <button type="submit" class="btn btn_submit" name="submit">Create</button>
            </div>
        </div>
    </form>
</div>
<?php require_once 'templates/footer.php'; ?>