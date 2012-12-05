<div id="customerList">
    <table id="customersDatatable" class="display">
        <thead>
            <?=
            $this->Html->tableHeaders( array (
                array ('Campaign' => array ('width' => '50px')),
                array ('Batch' => array ('width' => '40px')),
                array ('Status' => array ('width' => '10px')),
                array ('TL' => array ('width' => '10px')),
                array ('QA' => array ('width' => '10px')),
                array ('Response' => array ('width' => '50px')),
                array ('Name' => array ('width' => '120px')),
                array ('DOB' => array ('width' => '70px')),
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
                        $value['Campaign']['CampaignName'],
                        $value['Customer']['BatchNo'],
                        $value['Status']['Status'],
                        $value['Customer']['TL'],
                        $value['Customer']['QA'],
                        $value['Response']['Response'],
                        $value['Customer']['Name'],
                        $value['Customer']['DOB'],
                        $value['Customer']['Company'],
                        $value['Customer']['Homephone1'],
                        $value['Customer']['Homephone2'],
                        $value['Customer']['Handphone1'],
                        $value['Customer']['Handphone2']
                    )
                ),
                array (
                    'onclick' => 'Customer.setId('. $value['Customer']['Id'] .')',
                    'ondblclick' => 'User.initDetailsDialog()',
                ),
                array (
                    'onclick' => 'Customer.setId('. $value['Customer']['Id'] .')',
                    'ondblclick' => 'User.initDetailsDialog()',
                )
            );
            ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>