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
    public function tablesList($dbName = null)
    {
        if (empty($dbName)) {
            $this->Flash->error(__('No database with this name.'));
            return $this->redirect(['controller' => 'Databases', 'action' => 'index']);
        }

        $this->request->session()->delete('Db.tableName');
        $this->request->session()->write('Db.dbName', $dbName);

        $result = mysqli_query($this->mysqli, "SHOW TABLES FROM $dbName");
        $tables = [];
        if (!$result) {
            $this->Flash->error(__('No table exist for this database.'));
            return $this->redirect(['controller' => 'Databases', 'action' => 'index']);    
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $tables[] = $row['Tables_in_'.$dbName]; 
        }

        $this->set(compact('tables', 'dbName'));
    }

    public function data($dbName = null, $tableName = null)
    {
        if (!empty($dbName) && !empty($tableName)) {
            $query = 'SELECT * FROM '.$dbName.'.'.$tableName;
            $result = mysqli_query($this->mysqli, $query);
        }

        $this->request->session()->write('Db.dbName', $dbName);
        $this->request->session()->write('Db.tableName', $tableName);

        $rowsdata = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsdata[] = $row; 
        }

        $fieldNames = [];
        if (!empty($rowsdata)) {
            $fieldNames = array_keys($rowsdata[0]);
        }

        $this->set(compact('dbName', 'tableName', 'fieldNames', 'rowsdata'));

    }

    public function structure($dbName = null, $tableName = null) {
        if (!empty($dbName) && !empty($tableName)) {
            $query = 'DESCRIBE '.$dbName.'.'.$tableName;
            $result = mysqli_query($this->mysqli, $query);
        }

        $this->request->session()->write('Db.tableName', $tableName);

        $rowsdata = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsdata[] = $row; 
        }

        $fieldNames = [];
        if (!empty($rowsdata)) {
            $fieldNames = array_keys($rowsdata[0]);
        }

        $this->set(compact('dbName', 'tableName', 'fieldNames', 'rowsdata'));
    }

    public function updateRow()
    {
        $this->autoRender = false;

        if ($this->request->is('ajax')) {
            $dbName    = $this->request->data['dbname'];
            $tableName = $this->request->data['tablename'];
            $id        = $this->request->data['id'];
            $fieldName = $this->request->data['fieldName'];
            $newValue  = $this->request->data['newValue'];

            mysqli_select_db($this->mysqli, $dbName);
            $query = "UPDATE `".$tableName."` SET `".$fieldName."` = '".$newValue."' WHERE `id` = $id ";
            $result = mysqli_query($this->mysqli, $query);

            $msg = $this->mysqli->error;

            $this->_sendjson(compact('msg', 'result'));

        }
    }

}
