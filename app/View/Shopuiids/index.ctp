<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left">List of Shop UIIDs</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                <th>#</th>
                <th>Shop Name</th>
                <th>UIID</th>
                <th>Status</th>
                <th>Created At</th>
                <th class="text-center">操作</th>
            </thead>
            <tbody>
            <?php
            $no = ($this->Paginator->current() - 1) * $items_per_page;
            ?>
            <?php foreach ($shopuiids as $shopuiid): ?>
            <?php
            ++$no;
            ?>
            <tr>
                <td><?=$no?></td>
                <td><?=$this->Html->link($shopuiid['Shop']['login_id'], array('controller' => 'shops', 'action' => 'view', $shopuiid['Shop']['id']))?></td>
                <td><?=$shopuiid['Shopuiid']['uiid']?></td>
                <td>
                    <?php if ($shopuiid['Shopuiid']['status']):?>
                    <span class="label label-success">Active</span>
                    <?php else: ?>
                    <span class="label label-danger">Inactive</span>
                    <?php endif; ?>
                </td>
                <td><?php echo $this->Time->niceShort($shopuiid['Shopuiid']['created_at']); ?></td>
                <td class="text-center">
                    <?=$this->Html->link('編集', array('action' => 'edit', $shopuiid['Shopuiid']['id']), array('class' => 'btn btn-info'))?>
                    <button title="削除" class="btn btn-danger" id="deleteButton<?=$shopuiid['Shopuiid']['id']?>" onclick="removeShopuiidById(<?=$shopuiid['Shopuiid']['id']?>)">削除</button>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>
<script type="text/javascript">
    function removeShopuiidById(id) {
        if (confirm('Do you really want to delete?')) {
            var url = '/shopuiids/delete/' + id;
            $.ajax({
                url : url,
                type : 'DELETE',
                success : function(data) {
                    window.location.href = '/shopuiids';
                }
            });
        }
        return false;
    }
</script>