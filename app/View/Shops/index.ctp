<table>
    <thead>
        <th>
            <td>Login ID</td>
            <td>Name</td>
            <td>Role</td>
            <td>Price Selection</td>
            <td>Start Work Time</td>
            <td>View</td>
            <td>Edit</td>
            <td>Delete</td>
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
            <td><?=$this->Html->link($shop['Shop']['login_id'], '/shop/' . $shop['Shop']['id'])?></td>
            <td><?=$shop['Shop']['name']?></td>
            <td><?=$shop['Shop']['role']?></td>
            <td><?=number_format($shop['Shop']['price_selection'])?></td>
            <td><?=$shop['Shop']['start_work_time']?></td>
            <td><?=$this->Html->link('View', '/shop/' . $shop['Shop']['id'])?></td>
            <td><?=$this->Html->link('Edit', '/shop/' . $shop['Shop']['id'] . '/edit')?></td>
            <td><?=$this->Html->link('Delete', '/shop/' . $shop['Shop']['id'] . '/delete')?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->element('pagination'); ?>