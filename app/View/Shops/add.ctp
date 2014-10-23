<div class="users form">
<?php echo $this->Form->create('Shop');?>
<fieldset>
    <legend><?php echo __('Add Shop'); ?></legend>
    <?php echo $this->Form->input('login_id');
    echo $this->Form->input('name');
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->input('password_confirm', array('label' => 'Confirm Password *', 'maxLength' => 255, 'title' => 'Confirm password', 'type'=>'password'));
    echo $this->Form->input('role', array(
        'options' => array( 'king' => 'King', 'queen' => 'Queen', 'rook' => 'Rook', 'bishop' => 'Bishop', 'knight' => 'Knight', 'pawn' => 'Pawn')
    ));

    echo $this->Form->submit('Add Shop', array('class' => 'form-submit',  'title' => 'Click here to add the shop') );
?>
</fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php echo $this->element('sidebar'); ?>