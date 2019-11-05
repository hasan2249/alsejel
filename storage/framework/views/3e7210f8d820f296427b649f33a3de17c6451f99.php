<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-3 ">
            <div class="panel panel-default">
                <div class="panel-heading">side bar</div>

                <div class="panel-body">
                    
                    <ul class="list-group list-group-flush">
                        <a href="users" class="list-group-item">Users</a>
                        <a href="tasks" class="list-group-item">Tasks</a>
                        <a href="#" class="list-group-item">Reports</a>
                        <a href="#" class="list-group-item">Disabled</a>
                        <a href="#" class="list-group-item">Disabled</a>
                        <a href="#" class="list-group-item">Disabled</a>
                    </ul>
                    
                </div>
            </div>
        </div>
        
        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading text-center">SCASE</div>

                <div class="panel-body"> 
                   <?php echo $__env->yieldContent('content2'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>