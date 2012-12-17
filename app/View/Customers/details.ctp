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
    <div id="customerAddressTabs" style="height: 200px">
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
    <div id="clear"></div>
    <fieldset>
        <legend>Contact Information</legend>
        <table>
        <?=
            $this->Html->tableCells(array (
                array (
                    array ('Home Phone :', array ('align' => 'center')),
                    $this->Form->input('homephone1', array ('label' => false, 'class' => 'input-text', 'readonly' => 'readonly')),
                    $this->Html->link($this->Html->image('icons/icon-'. ($this->request->data['Customer']['homephone1'] != '' && in_array ($level, array (6, 7, 8)) ? 'call_green' : 'call_red') .'.png', array('align' => 'absmiddle')), 'javascript:void(0)', array('onmouseover' => 'Call.setNumber(\''. $this->request->data['Customer']['homephone1'] .'\')','onclick' => in_array($level, array (6, 7, 8)) ? 'Call.dial()' : '', 'escape' => false))
                ),
                array (
                    array ('Home Phone :', array ('align' => 'center')),
                    $this->Form->input('homephone2', array ('label' => false, 'class' => 'input-text')),
                    $this->Html->link($this->Html->image('icons/icon-'. ($this->request->data['Customer']['homephone2_apprv'] && in_array ($level, array (6, 7, 8)) ? 'call_green' : 'call_red') .'.png', array('align' => 'absmiddle')), 'javascript:void(0)', array('onmouseover' => 'Call.setNumber(\''. $this->request->data['Customer']['homephone2'] .'\')', 'onclick' => $this->request->data['Customer']['homephone2_apprv'] ? (in_array($level, array (6, 7, 8)) ? 'Call.dial()' : '') : (in_array($level, array (6, 7)) ? 'Call.initApproveNumberDialog(\'homephone2\')' : ''), 'escape' => false))
                ),
                array (
                    array ('Office Phone :', array ('align' => 'center')),
                    $this->Form->input('officephone1', array ('label' => false, 'class' => 'input-text', 'readonly' => 'readonly')),
                    $this->Html->link($this->Html->image('icons/icon-'. ($this->request->data['Customer']['officephone1'] != '' && in_array ($level, array (6, 7, 8)) ? 'call_green' : 'call_red') .'.png', array('align' => 'absmiddle')), 'javascript:void(0)', array('onmouseover' => 'Call.setNumber(\''. $this->request->data['Customer']['officephone1'] .'\')', 'onclick' => in_array($level, array (6, 7, 8)) ? 'Call.dial()' : '', 'escape' => false))
                ),
                array (
                    array ('Office Phone :', array ('align' => 'center')),
                    $this->Form->input('officephone2', array ('label' => false, 'class' => 'input-text')),
                    $this->Html->link($this->Html->image('icons/icon-'. ($this->request->data['Customer']['officephone2_apprv'] && in_array ($level, array (6, 7, 8)) ? 'call_green' : 'call_red') .'.png', array('align' => 'absmiddle')), 'javascript:void(0)', array('onmouseover' => 'Call.setNumber(\''. $this->request->data['Customer']['officephone2'] .'\')', 'onclick' => $this->request->data['Customer']['officephone2_apprv'] ? (in_array($level, array (6, 7, 8)) ? 'Call.dial()' : '') : in_array($level, array (6, 7)) ? 'Call.initApproveNumberDialog(\'officephone2\')' : '', 'escape' => false))
                ),
                array (
                    array ('Mobile Phone :', array ('align' => 'center')),
                    $this->Form->input('handphone1', array ('label' => false, 'class' => 'input-text', 'readonly' => 'readonly')),
                    $this->Html->link($this->Html->image('icons/icon-'. ($this->request->data['Customer']['handphone1'] != '' && in_array ($level, array (6, 7, 8)) ? 'call_green' : 'call_red') .'.png', array('align' => 'absmiddle')), 'javascript:void(0)', array('onmouseover' => 'Call.setNumber(\''. $this->request->data['Customer']['handphone1'] .'\')', 'onclick' => in_array($level, array (6, 7, 8)) ? 'Call.dial()' : '', 'escape' => false))
                ),
                array (
                    array ('Mobile Phone :', array ('align' => 'center')),
                    $this->Form->input('handphone2', array ('label' => false, 'class' => 'input-text')),
                    $this->Html->link($this->Html->image('icons/icon-'. ($this->request->data['Customer']['handphone2_apprv'] && in_array ($level, array (6, 7, 8)) ? 'call_green' : 'call_red') .'.png', array('align' => 'absmiddle')), 'javascript:void(0)', array('onmouseover' => 'Call.setNumber(\''. $this->request->data['Customer']['handphone2'] .'\')', 'onclick' => $this->request->data['Customer']['handphone2_apprv'] ? (in_array($level, array (6, 7, 8)) ? 'Call.dial()' : '') : in_array($level, array (6, 7)) ? 'Call.initApproveNumberDialog(\'handphone2\')' : '', 'escape' => false))
                )
            ));
        ?>
        </table>
    </fieldset>
</div>

<div style="float: right; width: 59%">
    <div id="logCalls" style="height: 150px"></div>
    <div id="clear"></div>
    <div style="margin-top: 8px">
        <?=
           $this->Html->tag('button', $this->Html->image('icons/icon-_question.png', array('align' => 'absmiddle')) . ' Questions', array ('type' => 'button', 'class' => 'transButton', 'style' => 'width: 110px', 'onclick' => 'Questions.loadPolicyQuestions()'))
           .' '.
           $this->Html->tag('button', $this->Html->image('icons/icon-_family.png', array('align' => 'absmiddle')) . ' Policy', array ('type' => 'button', 'class' => 'transButton', 'style' => 'width: 110px', 'onclick' => 'Customer.initEditDialog()'))
        ?>
    </div>
    <div id="clear" style="margin-top: 20px"></div>
    Call Note :<br />
    <?= $this->Html->tag('textarea', '', array ('cols' => 70, 'rows' => 8, 'id' => 'callNote', 'class' => 'input-text', 'readonly' => 'readonly')) ?>
</div>

<div id="clear" style="margin-top: 3px"><hr /></div>
<table width="100%">
<?=
    $this->Html->tableCells(array (
        array (
            array ($this->Form->button($this->Html->image('icons/icon-play.png', array('align' => 'absmiddle')) .' Playback', array ('type' => 'button', 'class' => 'transButton', 'Call.initPlaybackDialog()')) .' '. $this->Form->button($this->Html->image('icons/icon-submit.png', array('align' => 'absmiddle')) .' Submit', array ('type' => 'button', 'class' => 'transButton', 'onclick' => 'Customer.submit()')) .' '. $this->Form->button($this->Html->image('icons/icon-_details.png', array('align' => 'absmiddle')) .' Notice', array ('type' => 'button', 'class' => 'transButton', 'onclick' => 'Customer.showNotice()')), array ('align' => 'left', 'width' => '50%')),
            array ($this->Form->button('Save', array ('type' => 'button', 'class' => 'button')) .' '. $this->Form->button('Cancel', array ('type' => 'button', 'class' => 'button', 'onclick' => 'Functions.closeDialog(\'detailsDialog\')')), array ('align' => 'right', 'width' => '50%')),
        )
    ));
?>
</table>
<?= $this->Form->end(); ?>