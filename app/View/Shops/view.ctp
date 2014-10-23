<div class="panel panel-primary">
<div class="panel-heading clearfix">
    <h3 class="panel-title pull-left" style="padding-top: 7.5px;">Shop Detail</h3>
    <div class="btn-group pull-right">
        <?=$this->Html->link("List of Shops", array('action' => 'index'), array('escape' => false, 'class' => 'btn btn-success'))?>
    </div>
</div>
<div class="panel-body">
	<table class="table table-hover">
        <tr>
            <td scope="row" style=>ID</td>
            <td><?=$shop['Shop']['id']?></td>
        </tr>
        <tr>
            <td scope="row">Login ID</td>
            <td><?=$shop['Shop']['login_id']?></td>
        </tr>
        <tr>
            <td scope="row">Name</td>
            <td><?=$shop['Shop']['name']?></td>
        </tr>
        <tr>
            <td scope="row">Email</td>
            <td><?=$shop['Shop']['email']?></td>
        </tr>
        <tr>
            <td scope="row">Role</td>
            <td><?=$shop['Shop']['role']?></td>
        </tr>
        <tr>
            <td scope="row">Price Selection</td>
            <td><?=number_format($shop['Shop']['price_selection'])?></td>
        </tr>
        <tr>
            <td scope="row">Start work time</td>
            <td><?=$shop['Shop']['start_work_time']?></td>
        </tr>
        <tr>
            <td scope="row">Start unit interval</td>
            <td><?=$shop['Shop']['salary_unit_interval']?></td>
        </tr>
        <tr>
            <td scope="row">Back rate</td>
            <td><?=$shop['Shop']['back_rate']?></td>
        </tr>
        <tr>
            <td scope="row">Back rate target</td>
            <td><?=$shop['Shop']['back_rate_target']?></td>
        </tr>
        <tr>
            <td scope="row">Back rate to cast</td>
            <td><?=$shop['Shop']['back_rate_to_cast']?></td>
        </tr>
        <tr>
            <td scope="row">Back rate outsider</td>
            <td><?=$shop['Shop']['back_rate_outsider']?></td>
        </tr>
        <tr>
            <td scope="row">Back fee accompany</td>
            <td><?=$shop['Shop']['back_fee_accompany']?></td>
        </tr>
        <tr>
            <td scope="row">Back fee set selection</td>
            <td><?=$shop['Shop']['back_fee_set_selection']?></td>
        </tr>
        <tr>
            <td scope="row">Back fee table selection</td>
            <td><?=$shop['Shop']['back_fee_table_selection']?></td>
        </tr>
        <tr>
            <td scope="row">Interval Open</td>
            <td><?=$shop['Shop']['interval_open']?></td>
        </tr>
        <tr>
            <td scope="row">Created At</td>
            <td><?=$this->Time->niceShort($shop['Shop']['created_at'])?></td>
        </tr>
        <tr>
            <td scope="row">Updated At</td>
            <td><?=$this->Time->niceShort($shop['Shop']['updated_at'])?></td>
        </tr>
    </table>
<p class="text-center"><?=$this->Html->link("編集", array('action' => 'edit', $shop['Shop']['id']), array('escape' => false, 'class' => 'btn btn-info'))?></p>
</div>
</div>