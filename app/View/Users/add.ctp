  <link rel="stylesheet" href="/css/chosen.css">

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
        echo $this->Form->input('email', array(
            'type' => 'text',
            'div' => 'form-group',
            'label' => array('class' => 'control-label col-xs-3', 'text' => 'Email'),
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
            'selected' => '1',
            'class' => 'form-control',
        ));
        ?>

        <div class="form-group" id="shopBox" style="display:block">
            <label for="ShopShop" class="control-label col-xs-3">Shop</label>
            <div class="col-xs-6">
                <?php echo $this->Form->input('list_shop', array(
                    'options' => $list_shop,
                    'class' => "chosen-select",
                    'data-placeholder' => "Choose a shop..." ,
                    'multiple' => true,
                    'style' => "width:210px;",
                    'tabindex' => 3,
                    'label' => false,
                    'div' => false
                ));?>
            </div>
        </div>

        <div class="form-group" id="shopBoxMuti" style="display:none">
            <label for="ShopShop" class="control-label col-xs-3">Shop</label>
            <div class="col-xs-6">
                <?php echo $this->Form->input('shop', array(
                    'empty' => '- Choose shop -',
                    'options' => $list_shop,
                    'class' => 'form-control',
                    'data-placeholder' => "Choose a shop..." ,
                    'style' => "width:210px;",
                    'label' => false,
                ));?>
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
  <script src="/js/chosen.jquery.js" type="text/javascript"></script>
  <script src="/js/prism.js" type="text/javascript" charset="utf-8"></script>
<script>
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }

$('#UsersRole').change(function(){
    if($('#UsersRole').val() == 0){
        $('#shopBoxMuti').css('display','block');
        $('#shopBox').css('display','none');
    } else {
        $('#shopBoxMuti').css('display','none');
        $('#shopBox').css('display','block');
    }
});
</script>