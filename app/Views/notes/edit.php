<h2>Edit Note</h2>

<form action="<?= BASE_URL ?>NoteController/edit/<?= $note['id'] ?>" method="POST">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($note['title']) ?>" required><br><br>

    <label for="content">Content:</label><br>
    <textarea id="content" name="content" rows="6" required><?= htmlspecialchars($note['content']) ?></textarea><br><br>

    <button type="submit">Update Note</button>
</form>

<p><a href="<?= BASE_URL ?>NoteController/index">Back to Notes</a></p>
