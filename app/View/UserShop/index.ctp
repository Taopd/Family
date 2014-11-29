<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left" style="padding-top: 7.5px;">User - Shop</h3>
        <div class="btn-group pull-right">
            <?=$this->Html->link("Add Shop", array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-success'))?>
        </div>
    </div>
<div class="panel-body">
        <table class="table table-hover">
    <thead>
        <tr>
            <th class="selector">ユーザー</th>
            <th class="selector">店舗</th>
            <th class="selector">ユーザータイプ</th>
            <th class="actions"><?php echo __('操作'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($userShops as $userShop): ?>
        <tr>
            <td><?php echo h($userShop['Users']['username']); ?>&nbsp;</td>
            <td><?php echo h($userShop['Shop']['name']); ?>&nbsp;</td>
            <td><?php echo $role[$userShop['Users']['role']]; ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('編集'), array('action' => 'edit', $userShop['UserShop']['id'])); ?>
                <?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $userShop['UserShop']['id']), null, __('このレコードを削除しませんか： # %s?', $userShop['UserShop']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    <?php echo $this->element('pagination'); ?>
</div>