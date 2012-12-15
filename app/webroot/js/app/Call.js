
var Call = Class.create({
    
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    getLog: function() {
        new Ajax.Request(Functions.getAppAddress() + 'calls/getlog/' + Customer.getId(), {
            method: 'get',
            onLoading: function() {
                Functions.write('logCalls', '');
                jQuery("#logCalls").append('<div id="loadingImage"></div>');
                Functions.write('loadingImage', '<img src="' + Functions.getAppAddress() + 'img/loading.gif' + '" />');
                jQuery("#loadingImage").css('text-align', 'center');
            },
            onSuccess: function(response) {
                Functions.write('logCalls', response.responseText);
                Functions.initDatatable('logCallsDatatable', 150);
            }
        })
    }
})