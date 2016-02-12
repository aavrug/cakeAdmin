<?php $count = count($fieldNames); ?>
<div class="table-responsive">
  <?php if(!empty($rowsdata)) { ?>
  <table class="table table-striped">
      <thead>
        <tr>
            <?php foreach ($fieldNames as $fieldName) { ?>
            <th><?php echo __($fieldName); ?></th>  
            <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rowsdata as $rowdata) { ?>
        <tr>
          <?php for ($i=0; $i < $count; $i++) { ?>
          <td><?php echo $rowdata[$fieldNames[$i]]?$rowdata[$fieldNames[$i]]:'NULL'; ?></td> 
          <?php } ?>
        </tr>
        <?php } ?>
      </tbody>
  </table>
  <?php } ?>
</div>