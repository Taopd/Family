<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left" style="padding-top: 7.5px;">Add User</h3>
        <div class="btn-group pull-right">
            <?=$this->Html->link("List of User", array('action' => 'index'), array('escape' => false, 'class' => 'btn btn-success'))?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Users', array('class' => 'form-horizontal'));?>
        <?php
        
        echo $this->Form->input('name', array(
            'type' => 'text',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Name'),
            'between' => '<div class="col-xs-3">',
            'after' => '</div>',
            'class' => 'form-control',
        ));
        echo $this->Form->input('username', array(
            'type' => 'text',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Login ID'),
            'between' => '<div class="col-xs-3">',
            'after' => '</div>',
            'class' => 'form-control',
        ));
        echo $this->Form->input('password', array(
            'type' => 'password',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Password'),
            'between' => '<div class="col-xs-3">',
            'after' => '</div>',
            'class' => 'form-control',
        ));
        echo $this->Form->input('password_confirm', array(
            'type' => 'password',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Confirm Password'),
            'between' => '<div class="col-xs-3">',
            'after' => '</div>',
            'class' => 'form-control',
        ));        
        echo $this->Form->input('role', array(
            'options' => array('0' => '店舗', '1' => 'エリアマネージャ','2' => 'オーナー'),
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Role'),
            'between' => '<div class="col-xs-3">',
            'after' => '</div>',
            'class' => 'form-control',
        ));
        ?>

        <div class="form-group" id="shopBox" style="display:none">
            <label for="ShopShop" class="control-label col-xs-3">Shop</label>
            <div class="col-xs-6">
            <input type="hidden" name="data[Shop][shop_id]" value="" id="ShopShop">
            <table>
                <?php $index = 0 ;foreach ($list_shop as $key => $value) :?>
                    <?php if ($index % 4 == 0 ) : ?> <tr> <?php endif;?>
                    <td>
                        &nbsp;<input type="checkbox" name="data[Shop][shop_id][]" value="<?php echo $key; ?>" id="ShopShop<?php echo $key; ?>"/>
                        &nbsp;<label for="ShopShop<?php echo $key; ?>"><?php echo $value;?></label>
                    </td>
                    <?php if ($index % 4 == 0 ) : ?> </tr> <?php endif;?>
                    <?php $index ++;?>
                <?php endforeach;?>
            </table>
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
<script>
$('#UsersRole').change(function(){
    if($('#UsersRole').val() != 0){
        $('#shopBox').css('display','');
    } else {
        $('#shopBox').css('display','none');
    }
});
</script>