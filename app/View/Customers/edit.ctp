<div id="editCustomerTabs">
    <ul>
        <li style="width: 31%"><a href="#tabForm">Data</a></li>
        <li style="width: 31%"><a href="#tabPolicies">Tertanggung</a></li>
        <li style="width: 31%"><a href="#tabInformation">Keterangan</a></li>
    </ul>
    <div id="tabForm">
<?=
$this->Html->link('', '#top') .
$this->Html->tag('div', '', array ('id' => 'customerEditInfo')) .
$this->Form->create('Customer', array ('id' => 'CustomerEdit', 'name' => 'CustomerEdit')) .
$this->Form->input('id', array ('type' => 'hidden'))
?>

<table align="center" width="100%">

<?=
$this->Html->tableCells (array (
    array (
        array ('Name :', array ('align' => 'right')),
        $this->Form->input('name', array ('label' => false, 'class' => 'input-text', 'readonly' => true, 'onkeyup' => 'alert(\'field is readonly\')'))
    ),
    array (
        array ('Gender :', array ('align' => 'right')),
        $this->Form->input('gender_id', array ('label' => false, 'options' => $genders, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Date of Birth :', array ('align' => 'right')),
        $this->Form->input('birth_date', array ('label' => false, 'type' => 'text', 'id' => 'CustomerEditBirthDate', 'class' => 'input-text'))
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
        array ('Email :', array ('align' => 'right')),
        $this->Form->input('email', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Job :', array ('align' => 'right')),
        $this->Form->input('job_id', array ('label' => false, 'options' => $jobs, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Type of Business :', array ('align' => 'right')),
        $this->Form->input('business_type', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Income :', array ('align' => 'right')),
        $this->Form->input('income_id', array ('label' => false, 'options' => $incomes, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Insurance Purpose :', array ('align' => 'right')),
        $this->Form->input('purpose_id', array ('label' => false, 'options' => $purposes, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Credit Card Info', array ('align' => 'center', 'colspan' => 2, 'style' => 'font-weight: bold'))
    ),
    array (
        array ('Card Type (1) :', array ('align' => 'right')),
        $this->Form->input('card1_type_id', array ('label' => false, 'options' => $cards, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Bank Issuer (1) :', array ('align' => 'right')),
        $this->Form->input('card1_bank_issuer_id', array ('label' => false, 'options' => $banks, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Card Number (1) :', array ('align' => 'right')),
        $this->Form->input('card1_number', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Card Holder (1) :', array ('align' => 'right')),
        $this->Form->input('card1_holder', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Expired [MM:YY] (1) :', array ('align' => 'right')),
        $this->Form->input('card1_exp_month', array ('label' => false, 'div' => false, 'options' => $expired['month'], 'class' => 'input-text')) .' : '.
        $this->Form->input('card1_exp_year', array ('label' => false, 'div' => false, 'options' => $expired['year'], 'class' => 'input-text'))
    ),
    array (
        array ('Card Type (2) :', array ('align' => 'right')),
        $this->Form->input('card2_type_id', array ('label' => false, 'options' => $cards, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Bank Issuer (2) :', array ('align' => 'right')),
        $this->Form->input('card2_bank_issuer_id', array ('label' => false, 'options' => $banks, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Card Number (2) :', array ('align' => 'right')),
        $this->Form->input('card2_number', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Card Holder (2) :', array ('align' => 'right')),
        $this->Form->input('card2_holder', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Expired [MM:YY] (2) :', array ('align' => 'right')),
        $this->Form->input('card2_exp_month', array ('label' => false, 'div' => false, 'options' => $expired['month'], 'class' => 'input-text')) .' : '.
        $this->Form->input('card2_exp_year', array ('label' => false, 'div' => false, 'options' => $expired['year'], 'class' => 'input-text'))
    ),
    array (
        array ('Address Info', array ('align' => 'center', 'colspan' => 2, 'style' => 'font-weight: bold'))
    ),
    array (
        array ('Type of Address :', array ('align' => 'right')),
        $this->Form->input('address_type_id', array ('label' => false, 'options' => $addressTypes, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Address (1) :', array ('align' => 'right')),
        $this->Form->input('home_addr1', array ('label' => false, 'rows' => 2, 'cols' => 24, 'class' => 'input-text'))
    ),
    array (
        array ('Address (2) :', array ('align' => 'right')),
        $this->Form->input('home_addr2', array ('label' => false, 'rows' => 2, 'cols' => 24, 'class' => 'input-text'))
    ),
    array (
        array ('RT :', array ('align' => 'right')),
        $this->Form->input('home_rt', array ('label' => false, 'size' => 1, 'class' => 'input-text'))
    ),
    array (
        array ('RW :', array ('align' => 'right')),
        $this->Form->input('home_rw', array ('label' => false, 'size' => 1, 'class' => 'input-text'))
    ),
    array (
        array ('Kelurahan :', array ('align' => 'right')),
        $this->Form->input('home_kelurahan', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Kecamatan :', array ('align' => 'right')),
        $this->Form->input('home_kecamatan', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('City :', array ('align' => 'right')),
        $this->Form->input('home_city', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Province :', array ('align' => 'right')),
        $this->Form->input('home_province_id', array ('label' => false, 'options' => $provinces, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Zipcode :', array ('align' => 'right')),
        $this->Form->input('home_zip', array ('label' => false, 'size' => 3, 'class' => 'input-text'))
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
        $this->Form->input('live_zip', array ('label' => false, 'size' => 3, 'class' => 'input-text'))
    ),
    array (
        array ('Alamat Tagih', array ('align' => 'center', 'colspan' => 2, 'style' => 'font-weight: bold'))
    ),
    array (
        array ('Address (1) :', array ('align' => 'right')),
        $this->Form->input('receivable_address1', array ('label' => false, 'rows' => 2, 'cols' => 24, 'class' => 'input-text'))
    ),
    array (
        array ('Address (2) :', array ('align' => 'right')),
        $this->Form->input('receivable_address2', array ('label' => false, 'rows' => 2, 'cols' => 24, 'class' => 'input-text'))
    ),
    array (
        array ('RT :', array ('align' => 'right')),
        $this->Form->input('receivable_rt', array ('label' => false, 'size' => 1, 'class' => 'input-text'))
    ),
    array (
        array ('RW :', array ('align' => 'right')),
        $this->Form->input('receivable_rw', array ('label' => false, 'size' => 1, 'class' => 'input-text'))
    ),
    array (
        array ('Kelurahan :', array ('align' => 'right')),
        $this->Form->input('receivable_kelurahan', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Kecamatan :', array ('align' => 'right')),
        $this->Form->input('receivable_kecamatan', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('City :', array ('align' => 'right')),
        $this->Form->input('receivable_city', array ('label' => false, 'class' => 'input-text'))
    ),
    array (
        array ('Province :', array ('align' => 'right')),
        $this->Form->input('receivable_province_id', array ('label' => false, 'options' => $provinces, 'empty' => '(choose one)', 'class' => 'input-text'))
    ),
    array (
        array ('Zipcode :', array ('align' => 'right')),
        $this->Form->input('receivable_zip', array ('label' => false, 'size' => 3, 'class' => 'input-text'))
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
    </div>
    <div id="tabPolicies"></div>
    <div id="tabInformation"></div>
</div>