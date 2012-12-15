
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
                Functions.initDatatable('customersDatatable', 190);
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
        }
    }
})