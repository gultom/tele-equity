<?= $this->Html->tag('div', '', array ('id' => 'addInfo')); ?>
<?= $this->Form->create('Policy', array ('id' => 'PolicyAdd', 'name' => 'PolicyAdd')); ?>
<?= $this->Form->input('customer_id', array ('type' => 'hidden', 'value' => $customer_id)); ?>

<table align="center">

<?=
$this->Html->tableCells (array (
    array (
        array ('Relationship :', array ('align' => 'right')),
        $this->Form->input('relationship_id', array ('label' => false, 'options' => $relationships, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Name :', array ('align' => 'right')),
        $this->Form->input('name', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Gender :', array ('align' => 'right')),
        $this->Form->input('gender_id', array ('label' => false, 'options' => $genders, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Date of Birth :', array ('align' => 'right')),
        $this->Form->input('birth_date', array ('label' => false, 'type' => 'text', 'id' => 'PolicyBirthDate', 'class' => 'input-text'))
    ),
    array (
        array ('Religion :', array ('align' => 'right')),
        $this->Form->input('religion_id', array ('label' => false, 'options' => $religions, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('No. Identity :', array ('align' => 'right')),
        $this->Form->input('identity_id', array ('label' => false, 'div' => false, 'options' => $identities, 'empty' => '(choose one)', 'class' => 'input-text')) .' '.
        $this->Form->input('identity_number', array ('label' => false, 'div' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Citizenship :', array ('align' => 'right')),
        $this->Form->input('citizenship_id', array ('label' => false, 'options' => $citizenships, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Handphone :', array ('align' => 'right')),
        $this->Form->input('handphone', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Email :', array ('align' => 'right')),
        $this->Form->input('email', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Address :', array ('align' => 'right')),
        $this->Form->input('address', array ('label' => false, 'rows' => 2, 'cols' => 24, 'class' => 'input-text'))
    ),
    array (
        array ('RT :', array ('align' => 'right')),
        $this->Form->input('rt', array ('label' => false, 'size' => 1, 'class' => 'input-text'))
    ),
    array (
        array ('RW :', array ('align' => 'right')),
        $this->Form->input('rw', array ('label' => false, 'size' => 1, 'class' => 'input-text'))
    ),
    array (
        array ('Kelurahan :', array ('align' => 'right')),
        $this->Form->input('kelurahan', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Kecamatan :', array ('align' => 'right')),
        $this->Form->input('kecamatan', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('City :', array ('align' => 'right')),
        $this->Form->input('city', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Province :', array ('align' => 'right')),
        $this->Form->input('province_id', array ('label' => false, 'options' => $provinces, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Zipcode :', array ('align' => 'right')),
        $this->Form->input('postcode', array ('label' => false, 'size' => 3, 'class' => 'input-text'))
    ),
    array (
        array ('Phone :', array ('align' => 'right')),
        $this->Form->input('homephone', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Fax :', array ('align' => 'right')),
        $this->Form->input('fax', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Alamat Tinggal', array ('align' => 'center', 'colspan' => 2, 'style' => 'font-weight: bold'))
    ),
    array (
        array ('Address (1) :', array ('align' => 'right')),
        $this->Form->input('live_address1', array ('label' => false, 'rows' => 2, 'cols' => 24, 'class' => 'input-text'))
    ),
    array (
        array ('Address (2) :', array ('align' => 'right')),
        $this->Form->input('live_address2', array ('label' => false, 'rows' => 2, 'cols' => 24, 'class' => 'input-text'))
    ),
    array (
        array ('RT :', array ('align' => 'right')),
        $this->Form->input('live_rt', array ('label' => false, 'size' => 1, 'class' => 'input-text'))
    ),
    array (
        array ('RW :', array ('align' => 'right')),
        $this->Form->input('live_rw', array ('label' => false, 'size' => 1, 'class' => 'input-text'))
    ),
    array (
        array ('Kelurahan :', array ('align' => 'right')),
        $this->Form->input('live_kelurahan', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Kecamatan :', array ('align' => 'right')),
        $this->Form->input('live_kecamatan', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('City :', array ('align' => 'right')),
        $this->Form->input('live_city', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Province :', array ('align' => 'right')),
        $this->Form->input('live_province_id', array ('label' => false, 'options' => $provinces, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Zipcode :', array ('align' => 'right')),
        $this->Form->input('live_postcode', array ('label' => false, 'size' => 3, 'class' => 'input-text'))
    ),
    array (
        array ('<hr />', array ('colspan' => 2))
    ),
    array (
        array ($this->Form->button('Save', array ('class' => 'button')) .' '. $this->Form->button('Cancel', array('type' => 'button', 'class' => 'button', 'onclick' => 'Functions.closeDialog(\'customerEditDialog\')')), array ('align' => 'center', 'colspan' => 2))
    )
))
?>

</table>
<?= $this->Form->end(); ?>