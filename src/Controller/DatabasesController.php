<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;

/**
 * Static content controller
 *
 * This controller will render views from Template/Databases/
 *
 */
class DatabasesController extends AppController
{
    public function index()
    {
    }

    public function add()
    {
        $type    = 'error';
        $message = '';
        if ($this->request->is('post')) {
            $name = $this->request->data('name');
            if (empty($name)) {
                $type    = 'error';
                $message = 'Database name cannot be empty.';
            }

            $dbExist    = 'SHOW DATABASES LIKE "'.$name.'"';
            $checkExist = mysql_query($dbExist);
            if (!empty($name) && $checkExist) {
                $type    = 'error';
                $message = "The database name $name already exist.";
            }
            $query = 'CREATE DATABASE '.$name;
            $result = mysql_query($query);
            if (!empty($name) && $result) {
                $type    = 'success';
                $message = "The database $name has been successfully created.";
            }
            $this->Flash->{$type}(__($message));
            return $this->redirect(['controller' => 'Databases', 'action' => 'index']);
        }

    }

}
