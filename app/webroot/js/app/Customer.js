
var Customer = Class.create({
    
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    load: function() {
        Customer.setId(null);
        new Ajax.Request(Functions.getAppAddress() + 'customers/load', {
            method: 'get',
            parameters: Form.serialize('FilterCustomer'),
            onLoading: function() {
                Functions.write('customerList', '');
                jQuery("#customerList").append('<div id="loadingImage"></div>');
                Functions.write('loadingImage', '<img src="' + Functions.getAppAddress() + 'img/loading.gif' + '" />');
                jQuery("#loadingImage").css('text-align', 'center');
            },
            onSuccess: function(response) {
                Functions.write('customerList', response.responseText);
                Functions.initDatatable('customersDatatable', 210);
            }
        })
    },
    
    initDetailsDialog: function() {
        if (Customer.getId() === null) {
            Functions.write('customerInfo', '<b>Please select customer first.</b>');
            Functions.initInformationDialog('customerInfo', 300, 125);
            jQuery("#customerInfo").dialog('open');
        }
        else {
            new Ajax.Request(Functions.getAppAddress() + 'customers/details/' + Customer.getId(), {
                asynchronous: false,
                method: 'get',
                onSuccess: function(response) {
                    Functions.write('detailsDialog', response.responseText);
                }
            })
            jQuery('#detailsDialog').dialog('open');
            jQuery('#customerAddressTabs').tabs();
            if (typeof Call !== 'object')
                Call = new Call();
            Call.getLog();
            Functions.initCalendar('CustomerBirthDate');
            Functions.initDialog('customerEditDialog', 'Pemegang Polis', 530, 600);
            jQuery('#customerEditDialog').dialog('option', {
                modal: false,
                draggable: true
            })
        }
    },
    
    initEditDialog: function() {
        jQuery("#customerEditDialog").dialog('open');
        new Ajax.Request(Functions.getAppAddress() + 'customers/edit/' + Customer.getId(), {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('customerEditDialog', response.responseText);
                jQuery('#editCustomerTabs').tabs();
                Functions.initCalendar('CustomerEditBirthDate');
                Customer.isTransfer(jQuery('#CustomerPaymentMethodId').val());
                if (typeof Policy !== 'object')
                    Policy = new Policy();
                jQuery('#CustomerEdit').submit(function() {
                    Customer.edit();
                    jQuery('#customerEditDialog', window.parent.document).scrollTop(0);
                    return false;
                });
            }
        })
    },
    
    isTransfer: function(transferId) {
        var isTransfer = transferId == 2 ? true : false, transferTable, transferInfo;
        if (isTransfer) {
            transferTable= '<table width="100%" align="center">';
            transferTable += '<tr><td align="right">Paid Amount :</td><td><div class="input select"><input id="CustomerPaidAmount" class="input-text" type="text" name="data[Customer][paid_amount]" /></div></tr></td>';
            transferTable += '<tr><td align="right">Paid Date :</td><td><div class="input select"><input id="CustomerPaidDate" class="input-text" type="text" name="data[Customer][paid_date]" /></div></tr></td>';
            transferTable += '<tr><td align="right">Paid Val. No. :</td><td><div class="input select"><input id="CustomerValidationNo" class="input-text" type="text" name="data[Customer][paid_validation_no]" /></div></tr></td>';
            transferTable += '<tr><td align="right">Paid Amount :</td><td><div class="input select"><input id="CustomerPaidBankDestination" class="input-text" type="text" name="data[Customer][paid_bank_destination]" /></div></tr></td>';
            transferTable += '</table>';
            jQuery(transferTable).appendTo('#paidMethodInfo');
            new Ajax.Request(Functions.getAppAddress() + 'customers/getTransferInfo/' + Customer.getId(), {
                asynchronous: false,
                method: 'post',
                onSuccess: function(response) {
                    transferInfo = response.responseText.evalJSON();
                }
            })
            Functions.initCalendar('CustomerPaidDate');
            jQuery('#CustomerPaidAmount').val(transferInfo.Customer.paid_amount);
            jQuery('#CustomerPaidDate').val(transferInfo.Customer.paid_date);
            jQuery('#CustomerValidationNo').val(transferInfo.Customer.paid_validation_no);
            jQuery('#CustomerPaidBankDestination').val(transferInfo.Customer.paid_bank_destination);
        }
        else {
            Functions.write('paidMethodInfo', '');
        }
    },
    
    edit: function() {
        var useClass;
        new Ajax.Request(Functions.getAppAddress() + 'customers/edit', {
            asynchronous: false,
            method: 'post',
            parameters: Form.serialize('CustomerEdit'),
            onSuccess: function(response) {
                if (response.responseText === 'true') {
                    Functions.write('customerEditInfo', 'Customer has been saved');
                    useClass = 'info';
                }
                else {
                    Functions.write('customerEditInfo', 'Failed to save customer');
                    useClass = 'error';
                }
            }
        })
        jQuery('#customerEditInfo').addClass(useClass.toString());
        jQuery('#customerEditInfo').css('text-align', 'center');
        jQuery('#customerEditInfo').css('display', 'block');
        jQuery('#customerEditInfo').fadeOut(8000);
    },
    
    updateCustomerInfo: function() {
        new Ajax.Request(Functions.getAppAddress() + 'customers/updatecustomerinfo', {
            method: 'post',
            parameters: Form.serialize('CustomerInfo')
        })
    },
    
    getTotalPremium: function() {
        var total;
        new Ajax.Request(Functions.getAppAddress() + 'customers/gettotalpremium/' + Customer.getId(), {
            asynchronous: false,
            method: 'get',
            onSuccess: function(response) {
                total = response.responseText;
            }
        })
        return total;
    },
    
    submit: function() {
        
    },
    
    showNotice: function() {
        
    }
})