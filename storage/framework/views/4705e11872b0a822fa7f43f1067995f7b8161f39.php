<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Post</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
    <div class="container">
        <h1>Create a New Post</h1>
        
        <!-- Check for validation errors -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form for creating a new post -->
        <form action="<?php echo e(route('posts.store')); ?>" method="POST">
            <?php echo csrf_field(); ?> <!-- CSRF token for security -->
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="content">Content:</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <div>
                <button type="submit">Create Post</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel_project1\resources\views/posts/create.blade.php ENDPATH**/ ?>