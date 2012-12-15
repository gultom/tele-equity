<div id="customerDetailsInfo"></div>
<div id="questionDialog"></div>
<div id="customerEditDialog"></div>
<div id="callDetailsDialog"></div>
<div id="playBackDialog"></div>

<?=
$this->Form->create('Customer', array ('id' => 'CustomerDetails', 'name' => 'CustomerDetails')) .
$this->Form->input('id', array ('type' => 'hidden'));
?>

<div style="float: left; width: 40%">
    <div id="customerAddressTabs">
        <ul>
            <li style="width: 31%"><a href="#tabPersonal">Personal</a></li>
            <li style="width: 31%"><a href="#tabHome">Home</a></li>
            <li style="width: 31%"><a href="#tabOffice">Office</a></li>
        </ul>
        <div id="tabPersonal">
            <table width="100%">
                <?=
                    $this->Html->tableCells(array (
                        array (
                            array ('Name :', array ('align' => 'right')),
                            $this->Form->input('name', array ('label' => false, 'class' => 'input-text', 'readonly' =>  true))
                        ),
                        array (
                            array ('DOB :', array ('align' => 'right')),
                            $this->Form->input('birth_date', array ('label' => false, 'type' => 'text', 'class' => 'input-text', 'disabled' =>  true))
                        ),
                        array (
                            array ('Status :', array ('align' => 'right')),
                            $this->Form->input('status', array ('label' => false, 'value' => $status, 'class' => 'input-text', 'readonly' => true))
                        ),
                        array (
                            array ('Response :', array ('align' => 'righ')),
                            $this->Form->input('response_id', array ('label' => false, 'options' => $responses, 'empty' => '', 'class' => 'input-text'))
                        )
                    ));
                ?>
            </table>
        </div>
        <div id="tabHome">
            <table width="100%">
                <?=
                    $this->Html->tableCells(array (
                        array (
                            array ('Address :', array ('align' => 'right', 'rowspan' => 4)),
                            $this->Form->input('home_address1', array ('label' => false, 'class' => 'input-text', 'readonly' => true))
                        ),
                        array (
                            $this->Form->input('home_address2', array ('label' => false, 'class' => 'input-text', 'readonly' => true))
                        ),
                        array (
                            $this->Form->input('home_address3', array ('label' => false, 'class' => 'input-text', 'readonly' => true))
                        ),
                        array (
                            $this->Form->input('home_address4', array ('label' => false, 'class' => 'input-text', 'readonly' => true))
                        ),
                        array (
                            array ('City :', array ('align' => 'right')),
                            $this->Form->input('home_city', array ('label' => false, 'class' => 'input-text', 'readonly' => true))
                        ),
                        array (
                            array ('Zipcode :', array ('align' => 'right')),
                            $this->Form->input('home_zip', array ('label' => false, 'class' => 'input-text', 'readonly' => true))
                        )
                    ));
                ?>
            </table>
        </div>
        <div id="tabOffice">
            <table width="100%">
                <?=
                    $this->Html->tableCells(array (
                        array (
                            array ('Company :', array ('align' => 'right')),
                            $this->Form->input('company', array ('label' => false, 'class' => 'input-text', 'readonly' => true)),
                        ),
                        array (
                            array ('Address :', array ('align' => 'right', 'rowspan' => 2)),
                            $this->Form->input('office_addr1', array ('label' => false, 'class' => 'input-text', 'readonly' => true)),
                        ),
                        array (
                            $this->Form->input('office_addr2', array ('label' => false, 'class' => 'input-text', 'readonly' => true))
                        ),
                        array (
                            array ('City :', array ('align' => 'right')),
                            $this->Form->input('office_city', array ('label' => false, 'class' => 'input-text', 'readonly' => true))
                        ),
                        array (
                            array ('Zipcode :', array ('align' => 'right')),
                            $this->Form->input('office_zip', array ('label' => false, 'class' => 'input-text', 'readonly' => true))
                        )
                    ));
                ?>
            </table>
        </div>
    </div>
</div>

<div style="float: right; width: 59%">
    <div id="logCalls"></div>
</div>