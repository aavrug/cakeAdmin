<div class="table-responsive">
  <?php if(!empty($tables)) { ?>
  <table class="table table-striped">
      <thead>
        <tr>
            <th><?php echo __('Table name'); ?></th>
            <th colspan='6'><?php echo __('Action'); ?></th>
            <th><?php echo __('Rows'); ?></th>
            <th><?php echo __('Size'); ?></th>
            <th><?php echo __('Type'); ?></th>
            <th><?php echo __('Collation'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tables as $table) { ?>
        <tr>
          <td><?php echo $this->Html->link($table, ['controller' => 'Tables', 'action' => 'data', $dbName, $table]); ?></td> 
          <td><?php echo $this->Html->link('Browse', ['controller' => 'Tables', 'action' => 'data', $dbName, $table]); ?></td>
          <td><?php echo $this->Html->link('Structure', ['controller' => 'Tables', 'action' => 'structure', $dbName, $table]); ?></td>
          <td><?php echo $this->Html->link('Search', ['controller' => 'Tables', 'action' => 'table_data', $dbName, $table]); ?></td>
          <td><?php echo $this->Html->link('Insert', ['controller' => 'Tables', 'action' => 'table_data', $dbName, $table]); ?></td>
          <td><?php echo $this->Html->link('Empty', ['controller' => 'Tables', 'action' => 'table_data', $dbName, $table]); ?></td>
          <td><?php echo $this->Html->link('Drop', ['controller' => 'Tables', 'action' => 'table_data', $dbName, $table]); ?></td>
          <td><?php echo $this->Html->link('Rows', ['controller' => 'Tables', 'action' => 'table_data', $dbName, $table]); ?></td>
          <td><?php echo $this->Html->link('Size', ['controller' => 'Tables', 'action' => 'table_data', $dbName, $table]); ?></td>
          <td><?php echo $this->Html->link('Type', ['controller' => 'Tables', 'action' => 'table_data', $dbName, $table]); ?></td>
          <td><?php echo $this->Html->link('Collation', ['controller' => 'Tables', 'action' => 'table_data', $dbName, $table]); ?></td>
        </tr>
        <?php } ?>
      </tbody>
  </table>
  <?php } ?>
</div>