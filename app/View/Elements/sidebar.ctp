<?php echo $this->Html->link("Add A New Shop", array('action' => 'add'), array('escape' => false)); ?>
<br/>
<?php echo $this->Html->link("List Shops", array('action' => 'index'), array('escape' => false)); ?>
<br/>
<?php
echo $this->Html->link("Logout", array('controller' => 'sessions', 'action' => 'logout'));
?>