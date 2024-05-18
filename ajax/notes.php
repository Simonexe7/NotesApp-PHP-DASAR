<?php require_once '../functions.php';
$keyword = $_GET["keyword"];
$notes = findNote($keyword);
?>
<?php if (count($notes) == 0): ?>
    <h1 class="message">"<?= $keyword ?>" Tidak ditemukan</h1>
<?php endif; ?>
<?php foreach ($notes as $note): ?>
    <div class="card" id="notes" style="background-color: <?= $note['color']; ?>">
        <form method="GET">
            <input type="hidden" name="id" class="noteId" value="<?= $note['id'] ?>">
        </form>
        <div class="s-between">
            <div class="card-header">
                <div class="card-title"><?= $note["title"]; ?></div>
                <div class="tags">
                    <?php for ($i = 0; $i < count($note["tags"]); $i++): ?>
                        <a href="#">#<?= trim($note["tags"][$i]); ?> </a>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="card-body">
                <p><?= $note["body"]; ?></p>
            </div>
        </div>
        <div class="card-footer">
            <?php if ($note["created_at"] == $note["updated_at"]): ?>
                <div>
                    <p>Created</p>
                    <p class="time-create"><br><?= $note["created_at"]; ?></p>
                </div>
            <?php else: ?>
                <div>
                    <p>Updated</p>
                    <p class="time-create"><br><?= $note["updated_at"]; ?></p>
                </div>
            <?php endif; ?>
            <div class="action">
                <a href="updateNote.php?id=<?= $note['id'] ?>"><ion-icon class="icon icon_edit"
                        name="create-outline"></ion-icon></a>
                <ion-icon class="icon icon_hapus" name="trash-outline"></ion-icon>
            </div>
        </div>
    </div>
<?php endforeach; ?>