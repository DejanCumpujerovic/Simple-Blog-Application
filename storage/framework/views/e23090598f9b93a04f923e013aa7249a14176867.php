<!-- Display the Post -->
<link rel="stylesheet" href="<?php echo e(asset('css/show.css')); ?>">
<h1><?php echo e($post->title); ?></h1>
<p><?php echo e($post->content); ?></p>
<p>Written by: <?php echo e($post->user->name); ?></p>

<!-- Display Comments -->
<h3>Comments:</h3>
<ul>
    <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="comment">
        <p><?php echo e($comment->content); ?></p>

        <!-- Check if the user can delete the comment -->      
            <form action="<?php echo e(route('comments.destroy', $comment->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <li>
                    <?php echo e($comment->comment); ?>:<button type="submit" class="btn btn-danger">Delete Comment</button>
                </li>
            </form>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<!-- Comment Form -->
<h3>Add a Comment:</h3>
<form action="<?php echo e(route('comments.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
    <textarea name="comment" required placeholder="Add your comment here..."></textarea>
    <button type="submit">Submit Comment</button>
</form>

<?php /**PATH C:\xampp\htdocs\laravel_project1\resources\views/posts/show.blade.php ENDPATH**/ ?>