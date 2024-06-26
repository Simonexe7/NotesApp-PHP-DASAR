<?php
require_once 'templates/header.php';
require_once 'functions.php';
// mengambil data note berdasarkan id
$noteId = $_GET["id"];
$note = getNoteById($noteId);
?>
<div class="container">
    <div class="title">
        <h1>Note</h1>
    </div>

    <!-- form data -->
    <form id="noteForm">
        <div class="add-input">
            <input type="hidden" id="noteId" value="<?= $note['id']; ?>">
            <input type="text" placeholder="Title" name="title" value="<?= $note['title']; ?>" readonly>
            <input type="text" placeholder="Tags" name="tags" value="<?= $note['tags']; ?>" readonly>
            <textarea type="text" placeholder="Body" name="body" readonly><?= $note['body']; ?></textarea>
            <div class="action">
                <button type="button" class="btn" onclick="direct()">Back</button>
                <button type="button" class="btn btn_edit">Edit</button>
            </div>
        </div>
    </form>
</div>
<?php require_once 'templates/footer.php'; ?>