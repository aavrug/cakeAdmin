<div class="table-responsive">
	<?= $this->Form->create('database', ['url' => ['controller' => 'Databases', 'action' => 'add']], ['class' => 'form-horizontal form-bordered']) ?>
        <?php echo $this->Form->label(__('Create Database'), null, ['class' => 'control-label']); ?>
    <div class="form-group">
        <div class="col-md-3">
        <?php echo $this->Form->input('name', ['class' => 'form-control' ,'label' => false, 'placeholder' => 'Enter Database Name']); ?>
        </div>
        <div class="col-md-3">
        <?php echo $this->Form->input('collation', ['class' => 'form-control' ,'label' => false, 'placeholder' => 'Select Collation']); ?>
        </div>
        <div class="col-md-3">
            <?php echo $this->Form->button(__('Add'),['class' => 'btn btn-sm btn-success']); ?>
        </div>
    </div>       
    <?php echo $this->Form->end(); ?>
	<table class="table table-striped">
		<thead>
		<tr>
  			<th><?php echo __('Database name'); ?></th>
        </tr>
		</thead>
		<tbody>
  		<?php foreach ($databases as $database) { ?>
		<tr>
			<td><?php echo $this->Html->link($database, ['controller' => 'Tables', 'action' => 'tables_list', $database], ['data-name' => $database]); ?></td>	
		</tr>
		<?php } ?>
		</tbody>
	</table>
</div>