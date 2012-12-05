
var Customer = Class.create({
    
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    load: function() {
        new Ajax.Request(Functions.getAppAddress() + 'customers/view', {
            method: 'get',
            onLoading: function() {
                Functions.write('customerList', '');
                jQuery("#customerList").append('<div id="loadingImage"></div>');
                Functions.write('loadingImage', '<img src="' + Functions.getAppAddress() + 'img/loading.gif' + '" />');
                jQuery("#loadingImage").css('text-align', 'center');
            },
            onSuccess: function(response) {
                Functions.write('customerList', response.responseText);
                Functions.initDatatable('customersDatatable', 105);
            }
        })
    }
})