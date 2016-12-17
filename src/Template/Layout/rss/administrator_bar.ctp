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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-2 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
      
    </nav>
       <?= $this->Flash->render() ?>
    <div class="container clearfix">
     <nav class="large-2 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li><label><b><?= __('Gestión de Emergencias') ?></b></label></li>
            <li><?= $this->Html->link(__('Lista Emergencias'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Crear Emergencia'), ['action' => 'definirEmergencias']) ?></li>

            <li><label><b><?= _('Gestión de Habilidades')?></b></li>
            <li><?= $this->Html->link(__('Lista Habilidades'), ['action' => 'indexHabilidades']) ?></li>
            <li><?= $this->Html->link(__('Agregar Habilidad'), ['action' => 'addHabilidades']) ?></li>
            
        </ul>
    </nav>

    <div class="emergencies form large-10 medium-8 columns content">
        <?= $this->fetch('content') ?>
    </div>

    </div>
    <footer>
    </footer>
</body>
</html>
