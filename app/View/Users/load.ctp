<div id="userList">
    <table id="usersDatatable" class="display">
        <thead>
            <?= 
            $this->Html->tableHeaders( array (
                array ('Level' => array ('width' => '10px')),
                array ('User Code' => array ('width' => '65px')),
                array ('Username' => array ('width' => '10px')),
                array ('Fullname' => array ('width' => '120px')),
                array ('Active' => array ('width' => '10px')),
                array ('Join' => array ('width' => '70px')),
                array ('Expired' => array ('width' => '70px')),
                array ('Group' => array ('width' => '70px')),
                array ('TL' => array ('width' => '10px')),
                array ('QA' => array ('width' => '10px')),
                array ('Ext.' => array ('width' => '10px')),
            ));
            ?>
        </thead>
        <tbody>
    <?php foreach($users as $key => $value): ?>
    <?= 
    $this->Html->tableCells(array(
            array (
                $value['Level']['Level'],
                $value['User']['UserCode'],
                $value['User']['Username'],
                $value['User']['Fullname'],
                $value['User']['Active'],
                $value['User']['JoinDate'],
                $value['User']['ExpDate'],
                $value['Group']['Group'],
                $value['Group']['TL'],
                $value['User']['QA'],
                $value['User']['Extension']
            )
        ), 
        array (
            'onclick' => 'User.setId('. $value['User']['Id'] .')',
            'ondblclick' => 'User.initEditDialog()',
        ), 
        array (
            'onclick' => 'User.setId('. $value['User']['Id'] .')',
            'ondblclick' => 'User.initEditDialog()',
        )
    );
    ?>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>
