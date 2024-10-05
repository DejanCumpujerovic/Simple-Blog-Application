

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Posts</h1>

    <?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="post">
            <h2><?php echo e($post->title); ?></h2>
            <p><?php echo e($post->content); ?></p>
            <p>By: <?php echo e($post->user->name); ?></p>

            <!-- Edit Button -->
            <a href="<?php echo e(route('posts.edit', $post->id)); ?>" class="btn btn-warning">EditPost</a>
            <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="btn btn-warning">Unesi komentare</a>


            <!-- Display Comments -->
            <h3>Comments:</h3>
            <ul>
                <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <strong><?php echo e($comment->user->name); ?></strong>: <?php echo e($comment->comment); ?>

            </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div>
                ---------------------
            </div>


            <?php if(auth()->user()->id == $post->user_id): ?>
            <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">Delete Post</button>
            </form>
            <?php endif; ?>


        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\resources\views/posts/index.blade.php ENDPATH**/ ?>