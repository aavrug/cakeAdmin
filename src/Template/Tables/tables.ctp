<div class="table-responsive">
  <?php if(!empty($tables)) { ?>
  <table class="table table-striped">
      <thead>
        <tr>
            <th><?php echo __('Table name'); ?></th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($tables as $table) { ?>
        <tr>
      <td><?php echo $this->Html->link($table, ['controller' => 'Tables', 'action' => 'table_data', $dbName, $table]); ?></td> 
        </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } ?>
</div>