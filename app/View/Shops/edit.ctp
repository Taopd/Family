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
        ?>
        <?php
        echo $this->Form->input('name', array(
            'type' => 'text',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Name'),
            'between' => '<div class="col-xs-3">',
            'after' => '</div>',
            'class' => 'form-control',
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