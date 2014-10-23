<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left" style="padding-top: 7.5px;">Edit Shop UIID</h3>
        <div class="btn-group pull-right">
            <?=$this->Html->link("List of UIIDs", array('action' => 'index'), array('escape' => false, 'class' => 'btn btn-success'))?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Shopuiid', array('class' => 'form-horizontal'));?>
        <?php
        echo $this->Form->hidden('id', array('value' => $this->data['Shopuiid']['id']));
        ?>
        <div class="form-group">
            <label class="control-label col-xs-3">Shop Name</label>
            <div class="col-xs-9">
                <p class="form-control-static"><?=$this->data['Shop']['name']?></p>
            </div>
        </div>
        <?php
        echo $this->Form->input('uiid', array(
            'type' => 'text',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'UIID'),
            'between' => '<div class="col-xs-4">',
            'after' => '</div>',
            'class' => 'form-control',
        ));
        ?>
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <div class="checkbox">
                    <?=$this->Form->checkbox('status', array(
                        'value' => 1,
                        'checked' => $this->data['Shopuiid']['status'] ? true : false,
                        ));?>&nbsp;Active
                </div>
            </div>
        </div>
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