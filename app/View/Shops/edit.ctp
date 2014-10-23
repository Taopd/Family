<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left" style="padding-top: 7.5px;">Edit Shop</h3>
        <div class="btn-group pull-right">
            <?=$this->Html->link("List of Shops", array('action' => 'index'), array('escape' => false, 'class' => 'btn btn-success'))?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Shop', array('class' => 'form-horizontal'));?>
        <?php
        echo $this->Form->hidden('id', array('value' => $this->data['Shop']['id']));
        echo $this->Form->hidden('login_id', array('value' => $this->data['Shop']['login_id']));
        ?>
        <div class="form-group">
            <label class="control-label col-xs-3">Login ID</label>
            <div class="col-xs-9">
                <p class="form-control-static"><?=$this->data['Shop']['login_id']?></p>
            </div>
        </div>
        <?php
        echo $this->Form->input('name', array(
            'type' => 'text',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Name'),
            'between' => '<div class="col-xs-3">',
            'after' => '</div>',
            'class' => 'form-control',
        ));
        echo $this->Form->input('email', array(
            'type' => 'email',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Email'),
            'between' => '<div class="col-xs-3">',
            'after' => '</div>',
            'class' => 'form-control',
        ));
        echo $this->Form->input('password_update', array(
            'type' => 'password',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Password'),
            'between' => '<div class="col-xs-3">',
            'after' => '</div>',
            'class' => 'form-control',
            'required' => false,
        ));
        echo $this->Form->input('password_update_confirm', array(
            'type' => 'password',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Confirm Password'),
            'between' => '<div class="col-xs-3">',
            'after' => '</div>',
            'class' => 'form-control',
            'required' => false,
        ));
        ?>
        <div class="form-group">
            <?php
            echo $this->Form->submit(__('Submit'), array(
                'div' => 'col-xs-offset-3 col-xs-9',
                'class' => 'btn btn-primary',
            ));
            ?>
        </div>
        <?php
        echo $this->Form->end();
        ?>
    </div>
</div>