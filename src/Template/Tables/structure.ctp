<?php $count = count($fieldNames); ?>
<div class="table-responsive">
  <?php if(!empty($rowsdata)) { ?>
  <?php echo $this->Form->input('dbname', ['label' => false, 'value' => $dbName, 'class' => 'hidden']); ?>
  <?php echo $this->Form->input('tablename', ['label' => false, 'value' => $tableName, 'class' => 'hidden']); ?>
  <table id='tables-data' class="table table-striped">
      <thead>
        <tr>
            <?php foreach ($fieldNames as $fieldName) { ?>
            <th><?php echo __($fieldName); ?></th>  
            <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rowsdata as $rowdata) { ?>
        <tr id='<?php echo $rowdata[$fieldNames[0]]; ?>'>
          <?php for ($i=0; $i < $count; $i++) { ?>
          <td id='<?php echo $rowdata[$fieldNames[0]]."-".$fieldNames[$i]; ?>' data-field='<?php echo $fieldNames[$i]; ?>'>
            <?php 
            if (is_null($rowdata[$fieldNames[$i]])) {
              echo 'NULL';
            } elseif (empty($rowdata[$fieldNames[$i]])) {
              echo '';
            } else {
              echo $rowdata[$fieldNames[$i]];
            } ?>
          </td> 
          <?php } ?>
        </tr>
        <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
  <p>There is no data in this table.</p>
  <?php } ?>
</div>