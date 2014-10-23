<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <h1><i class='fa fa-lock'></i> Login</h1>
        <?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
        <div class="form-group">
            <?=$this->Form->input('username', array('type' => 'text', 'class' => 'form-control'));?>
        </div>
        <div class="form-group">
            <?=$this->Form->input('password', array('type' => 'password', 'class' => 'form-control'));?>
        </div>
        <div class="form-group">
            <?=$this->Form->submit(__('Login'), array('class' => 'btn btn-primary'));?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>