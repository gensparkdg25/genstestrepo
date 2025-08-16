<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mini Blog</title>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Mini Blog</h1>

    <!-- AJAX Form -->
    <form id="postForm" class="mb-6 bg-white p-4 rounded shadow">
        <input type="text" name="title" placeholder="Title" class="w-full p-2 border mb-2 rounded" required>
        <textarea name="content" placeholder="Content" class="w-full p-2 border mb-2 rounded" required></textarea>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Post</button>
    </form>

    <div id="postsContainer" class="space-y-6">
        <?php foreach ($post as $posts): ?>
        <div class="bg-white shadow-md rounded-lg p-4 max-w-xl mx-auto" id="post-<?= $posts['id'] ?>">
            <div class="flex items-center justify-between mb-2">
                <div class="text-gray-700 font-semibold post-title" contenteditable="false">
                    POST #<?= $posts['id'] ?> - <?= htmlspecialchars($posts['title']) ?>
                </div>
                <div class="text-gray-400 text-sm"><?= $posts['created_at'] ?></div>
            </div>
            <div class="text-gray-800 mb-4 post-content" contenteditable="false"><?= nl2br(htmlspecialchars($posts['content'])) ?></div>
            <div class="flex space-x-4 text-blue-600 text-sm">
                <button type="button" class="editBtn" data-id="<?= $posts['id'] ?>">Edit</button>
                <button type="button" class="deleteBtn" data-id="<?= $posts['id'] ?>">Delete</button>
                <button type="button" class="saveBtn hidden" data-id="<?= $posts['id'] ?>">Save</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
const form = document.getElementById('postForm');
const postsContainer = document.getElementById('postsContainer');

// Create new post
form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch("<?= BASE_URL ?>PostController/create", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            const post = data.post;
            const postHtml = `
            <div class="bg-white shadow-md rounded-lg p-4 max-w-xl mx-auto" id="post-${post.id}">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-gray-700 font-semibold post-title" contenteditable="false">
                        POST #${post.id} - ${post.title}
                    </div>
                    <div class="text-gray-400 text-sm">${post.created_at}</div>
                </div>
                <div class="text-gray-800 mb-4 post-content" contenteditable="false">${post.content.replace(/\n/g, '<br>')}</div>
                <div class="flex space-x-4 text-blue-600 text-sm">
                    <button type="button" class="editBtn" data-id="${post.id}">Edit</button>
                    <button type="button" class="deleteBtn" data-id="${post.id}">Delete</button>
                    <button type="button" class="saveBtn hidden" data-id="${post.id}">Save</button>
                </div>
            </div>`;
            postsContainer.insertAdjacentHTML('afterbegin', postHtml);
            form.reset();
        } 
    })
    .catch(err => console.error("AJAX error:", err));
});

// Edit, Save, and Delete functionality
postsContainer.addEventListener('click', function(e){
    const id = e.target.dataset.id;
    if(!id) return;

    const postDiv = document.getElementById('post-' + id);
    const titleDiv = postDiv.querySelector('.post-title');
    const contentDiv = postDiv.querySelector('.post-content');
    const editBtn = postDiv.querySelector('.editBtn');
    const saveBtn = postDiv.querySelector('.saveBtn');

    // Delete post
    if(e.target.classList.contains('deleteBtn')){
        if(confirm("Are you sure you want to delete this post?")){
            fetch("<?= BASE_URL ?>PostController/delete/" + id, { method: "POST" })
            .then(res => res.json())
            .then(data => {
                if(data.success) postDiv.remove();
            })
            .catch(err => console.error("AJAX error:", err));
        }
    }

    // Edit post (inline)
    if(e.target.classList.contains('editBtn')){
        titleDiv.contentEditable = true;
        contentDiv.contentEditable = true;
        titleDiv.focus();
        editBtn.classList.add('hidden');
        saveBtn.classList.remove('hidden');
    }

    // Save post
    if(e.target.classList.contains('saveBtn')){
        const newTitle = titleDiv.innerText.split(" - ")[1].trim();
        const newContent = contentDiv.innerText.trim();

        const formData = new FormData();
        formData.append('title', newTitle);
        formData.append('content', newContent);

        fetch("<?= BASE_URL ?>PostController/edit/" + id, { method: "POST", body: formData })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                titleDiv.contentEditable = false;
                contentDiv.contentEditable = false;
                editBtn.classList.remove('hidden');
                saveBtn.classList.add('hidden');
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch(err => console.error("AJAX error:", err));
    }
});
</script>

</body>
</html>
