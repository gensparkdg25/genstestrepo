<h2>Notes</h2>

<a href="<?= BASE_URL ?>NoteController/create">+ Add Note</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($notes as $note): ?>
        <tr>
            <td><?= $note['id'] ?></td>
            <td><?= htmlspecialchars($note['title']) ?></td>
            <td><?= nl2br(htmlspecialchars($note['content'])) ?></td>
            <td><?= $note['created_at'] ?></td>
            <td>
                <!-- You can implement edit/delete later -->
                <a href="<?= BASE_URL ?>NoteController/edit/<?= $note['id'] ?>">Edit</a> |
                <a href="<?= BASE_URL ?>NoteController/delete/<?= $note['id'] ?>" onclick="return confirm('Delete this note?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
