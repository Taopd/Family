<div class="shops form">
<h1>Shops</h1>
<table>
    <thead>
        <th>
            <td>Login ID</td>
            <td>Name</td>
            <td>Role</td>
            <td>Price Selection</td>
            <td>Start Work Time</td>
            <td>Created At</td>
            <td>操作</td>
        </th>
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
            <td><?=$this->Html->link($shop['Shop']['login_id'], array('action' => 'view', $shop['Shop']['id']))?></td>
            <td><?=$shop['Shop']['name']?></td>
            <td><?=$shop['Shop']['role']?></td>
            <td><?=number_format($shop['Shop']['price_selection'])?></td>
            <td><?=$shop['Shop']['start_work_time']?></td>
            <td><?php echo $this->Time->niceShort($shop['Shop']['created_at']); ?></td>
            <td>
                <?=$this->Html->link('View', array('action' => 'view', $shop['Shop']['id']))?> |
                <?=$this->Html->link('編集', array('action' => 'edit', $shop['Shop']['id']))?> |
                <?=$this->Html->link('削除', array('action' => 'delete', $shop['Shop']['id']))?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->element('pagination'); ?>
</div>
<?php echo $this->element('sidebar'); ?>