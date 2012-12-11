<div id="campaignList">
    <table id="campaignDatatable" class="display">
        <thead>
            <?=
            $this->Html->tableHeaders( array (
                array ('Del.' => array ('width' => '10px')),
                array ('Name' => array ('width' => '120px')),
                array ('Added' => array ('width' => '80px')),
                array ('Added By' => array ('width' => '80px'))
            ));
            ?>
        </thead>
        <tbody>
            <?php foreach ($campaigns as $key => $value): ?>
            <?=
            $this->Html->tableCells(array (
                array (
                    array ($this->Html->link($this->Html->image('icons/icon-minus.png'), 'javascript:void(0)', array('escape' => false, 'onmouseover' => 'Campaign.setId('. $value['Campaign']['Id'] .')', 'onclick' => 'Campaign.initDeleteDialog()')), array('align' => 'center')),
                    $value['Campaign']['Name'],
                    $value['Campaign']['Added'],
                    $value['Campaign']['AddedBy']
                )
            ),
            array (
                'onclick' => 'Campaign.setId('. $value['Campaign']['Id'] .')',
                'ondblclick' => 'Campaign.initEditDialog()'
            ),
            array (
                'onclick' => 'Campaign.setId('. $value['Campaign']['Id'] .')',
                'ondblclick' => 'Campaign.initEditDialog()'
            ));
            ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>