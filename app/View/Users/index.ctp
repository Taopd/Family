<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left" style="padding-top: 7.5px;">User</h3>
        <div class="btn-group pull-right">
            <?=$this->Html->link("Add User", array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-success'))?>
        </div>
    </div>
<div class="panel-body">
        <table class="table table-hover">
    <thead>
        <tr>
            <th class="selector">名前</th>
            <th class="selector">LoginID</th>
            <th class="selector">ユーザータイプ</th>
            <th class="actions"><?php echo __('操作'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo h($user['Users']['name']); ?>&nbsp;</td>
            <td><?php echo h($user['Users']['username']); ?>&nbsp;</td>
            <td><?php echo $role[$user['Users']['role']]; ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('編集'), array('action' => 'edit', $user['Users']['id'])); ?>
                <?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $user['Users']['id']), null, __('このレコードを削除しませんか： # %s?', $user['Users']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    <?php echo $this->element('pagination'); ?>
</div>