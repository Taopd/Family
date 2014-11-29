<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">MOTAPP Shop Management</a>
</div>
<div class="navbar-collapse collapse">
    <?php if ($this->Session->check('Auth.User')) :?>
    <ul class="nav navbar-nav">
        <li><?=$this->Html->link('Shops', array('controller' => 'shops', 'action' => 'index'))?></li>
        <li><?=$this->Html->link('Shop UIIDs', array('controller' => 'shopuiids', 'action' => 'index'))?></li>
        <li><?=$this->Html->link('User Shop', array('controller' => 'UserShop', 'action' => 'index'))?></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=AuthComponent::user('username')?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><?=$this->Html->link('Logout', array('controller' => 'sessions', 'action' => 'logout'))?></li>
            </ul>
        </li>
    </ul>
    <?php endif;?>
</div><!--/.navbar-collapse -->