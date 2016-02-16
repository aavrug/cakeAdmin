<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['bootstrap.css', 'bootstrap-theme.css', 'dashboard.css', 'custom.css']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?= __('CakeAdmin') ?></a>
        </div>
        <!-- <div id="navbar" class="navbar-collapse collapse"> -->
          <!-- <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
          </ul> -->
          <!-- <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form> -->
        <!-- </div> -->
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <input type="text" class="form-control" id='search-db-name' placeholder="Search">
            <ul class="nav nav-sidebar" id='sidebar'>
            <?php foreach ($databases as $database) { ?>
            <li><?php echo $this->Html->link($database, ['controller' => 'Tables', 'action' => 'tables', $database], ['data-name' => $database]); ?></li> 
            <?php } ?>
            </ul>
        </div>
        <div class="col-sm-offset-3 col-md-offset-2">
          <div  id='breadcrumb' class="container-fluid">
            <div>
              <ul>
                <li>>> <span class="glyphicon glyphicon-cd" aria-hidden="true"></span><?php echo $this->Html->link('Home', ['controller' => 'Databases', 'action' => 'index']); ?></li>
                <?php $dbName = $this->request->session()->read('Db.dbName'); ?>
                <?php if ($dbName) { ?>
                <li>>> <span class="glyphicon glyphicon-oil" aria-hidden="true"></span><?php echo $this->Html->link($dbName, ['controller' => 'Tables', 'action' => 'tables_list', $dbName]); ?></li>
                <?php } ?>
                <?php $tableName = $this->request->session()->read('Db.tableName'); ?>
                <?php if ($dbName && $tableName) { ?>
                <li>>> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><?php echo $this->Html->link($tableName, ['controller' => 'Tables', 'action' => 'data', $dbName, $tableName]); ?></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <nav class="navbar col-sm-offset-3 col-md-offset-2">
          <div class="container-fluid">
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-left">
                <!-- <li><a href="#"></a></li> -->
              </ul>
            </div>
          </div>
        </nav>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        </div>
      </div>
    </div>
    <footer>
    </footer>
    <?= $this->Html->script(['jquery-1.12.0.js', 'bootstrap.js', 'custom.js']) ?>
</body>
</html>
