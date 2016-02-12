<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;

/**
 * Static content controller
 *
 * This controller will render views from Template/Tables/
 *
 */
class TablesController extends AppController
{
    public function tables($dbName = null)
    {
        if (empty($dbName)) {
            $this->Flash->error(__('No database with this name.'));
            return $this->redirect(['controller' => 'Databases', 'action' => 'index']);
        }

        $result = mysql_query("SHOW TABLES FROM $dbName");
        $tables = [];
        if (!$result) {
            $this->Flash->error(__('No table exist for this database.'));
            return $this->redirect(['controller' => 'Databases', 'action' => 'index']);    
        }
        while ($row = mysql_fetch_assoc($result)) {
            $tables[] = $row['Tables_in_'.$dbName]; 
        }

        $this->set(compact('tables', 'dbName'));
    }

    public function tableData($dbName = null, $tableName = null)
    {
        if (!empty($dbName) && !empty($tableName)) {
            $query = 'SELECT * FROM '.$dbName.'.'.$tableName;
            $result = mysql_query($query);
        }

        $rowsdata = [];
        while ($row = mysql_fetch_assoc($result)) {
            $rowsdata[] = $row; 
        }

        if (!empty($rowsdata)) {
            $fieldNames = array_keys($rowsdata[0]);
        }

        $this->set(compact('fieldNames', 'rowsdata'));

    }

}
