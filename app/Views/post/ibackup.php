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

<form method="post" action="<?= BASE_URL ?>PostController/create" class="mb-6 bg-white p-4 rounded shadow">
        <input type="text" name="title" placeholder="Title" class="w-full p-2 border mb-2 rounded" required>
        <textarea name="content" placeholder="Content" class="w-full p-2 border mb-2 rounded" required></textarea>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Post</button>
    </form>

<div class="space-y-6">
<?php foreach ($post as $posts): ?>
    <div class="bg-white shadow-md rounded-lg p-4 max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-2">
            <div class="text-gray-700 font-semibold">
                POST #<?= $posts['id'] ?> - <?= htmlspecialchars($posts['title']) ?>
            </div>
            <div class="text-gray-400 text-sm"><?= $posts['created_at'] ?></div>
        </div>
        <div class="text-gray-800 mb-4"><?= nl2br(htmlspecialchars($posts['content'])) ?></div>
        <div class="flex space-x-4 text-blue-600 text-sm">
            <!-- Actions if needed -->
        </div>
    </div>
<?php endforeach; ?>
</div>



    
</div>

</body>
</html>
