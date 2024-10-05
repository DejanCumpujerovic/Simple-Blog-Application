

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Post</h1>
    <link rel="stylesheet" href="<?php echo e(asset('css/edit.css')); ?>">

    <form action="<?php echo e(route('posts.update', $post->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $post->title)); ?>" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" rows="5" required><?php echo e(old('content', $post->content)); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project1\resources\views/posts/edit.blade.php ENDPATH**/ ?>