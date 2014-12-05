<div class="panel panel-primary">
    <div class="panel-heading clearfix">
        <h3 class="panel-title pull-left" style="padding-top: 7.5px;">List of Shops</h3>
        <div class="btn-group pull-right">
            <?=$this->Html->link("Add Shop", array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-success'))?>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Created At</th>
                <th class="text-center">操作</th>
            </thead>
            <tbody>
            <?php
            $no = ($this->Paginator->current() - 1) * $items_per_page;
            ?>
            <?php foreach ($shops as $shop): ?>
            <?php
            ++$no;
            ?>
            <tr>
                <td><?=$no?></td>
                <td><?=$this->Html->link($shop['Shop']['name'], array('action' => 'view', $shop['Shop']['id']))?></td>
                <td><?php echo $shop['Shop']['created_at'] ? $this->Time->niceShort($shop['Shop']['created_at']) : ''; ?></td>
                <td class="text-center">
                    <?=$this->Html->link('編集', array('action' => 'edit', $shop['Shop']['id']), array('class' => 'btn btn-info'))?>
                    <button title="削除" class="btn btn-danger" id="deleteButton<?=$shop['Shop']['id']?>" onclick="removeShopById(<?=$shop['Shop']['id']?>)">削除</button>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>
<script type="text/javascript">
    function removeShopById(id) {
        if (confirm('Do you really want to delete?')) {
            var url = '/shops/delete/' + id;
            $.ajax({
                url : url,
                type : 'DELETE',
                success : function(data) {
                    window.location.href = '/shops';
                }
            });
        }
        return false;
    }
</script>