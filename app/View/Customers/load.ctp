    <table id="customersDatatable" class="display">
        <thead>
            <?=
            $this->Html->tableHeaders( array (
                array ('Campaign' => array ('width' => '80px')),
                array ('Batch' => array ('width' => '75px')),
                array ('Status' => array ('width' => '40px')),
                array ('TM' => array ('width' => '20px')),
                array ('TL' => array ('width' => '20px')),
                array ('SPV' => array ('width' => '20px')),
                array ('QA' => array ('width' => '20px')),
                array ('Response' => array ('width' => '100px')),
                array ('Name' => array ('width' => '120px')),
                array ('DOB' => array ('width' => '40px')),
                array ('Company' => array ('width' => '70px')),
                array ('Home ph. 1' => array ('width' => '50px')),
                array ('Home ph. 2' => array ('width' => '50px')),
                array ('Handphone 1' => array ('width' => '50px')),
                array ('Handphone 2' => array ('width' => '50px'))
            ));
            ?>
        </thead>
        <tbody>
            <?php foreach ($customers as $key => $value): ?>
            <?= 
            $this->Html->tableCells(array(
                    array (
                        $value['Import']['Campaign']['Name'],
                        $value['Customer']['batch_no'],
                        $value['Status']['Status'],
                        $value['TM']['Username'],
                        $value['TL']['Username'],
                        $value['SPV']['Username'],
                        $value['QA']['Username'],
                        $value['Response']['Response'],
                        $value['Customer']['name'],
                        $value['Customer']['birth_date'],
                        $value['Customer']['company'],
                        $value['Customer']['homephone1'],
                        $value['Customer']['homephone2'],
                        $value['Customer']['handphone1'],
                        $value['Customer']['handphone2']
                    )
                ),
                array (
                    'onclick' => 'Customer.setId('. $value['Customer']['id'] .')',
                    'ondblclick' => 'User.initDetailsDialog()',
                ),
                array (
                    'onclick' => 'Customer.setId('. $value['Customer']['id'] .')',
                    'ondblclick' => 'User.initDetailsDialog()',
                )
            );
            ?>
            <?php endforeach; ?>
        </tbody>
    </table>