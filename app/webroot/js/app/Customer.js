
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
                jQuery('#CustomerEdit').submit(function() {
                    Customer.edit();
                    jQuery('#customerEditDialog', window.parent.document).scrollTop(0);
                    return false;
                });
            }
        })
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
    
    submit: function() {
        
    },
    
    showNotice: function() {
        
    }
})