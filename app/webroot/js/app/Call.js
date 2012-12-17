
var Call = Class.create({
    
    id: null,
    number: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    setNumber: function(number) {
        this.number = number == '' ? null : number;
    },
    
    getNumber: function() {
        return this.number;
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
                Functions.initDatatable('logCallsDatatable', 180, 110);
                jQuery('.dataTables_wrapper').css('min-height', '120px'); // fix default datatables (320px) oversize man !!
            }
        })
    },
    
    getCallNote: function() {
        new Ajax.Request(Functions.getAppAddress() + 'calls/getcallnote/' + Call.getId(), {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('callNote', response.responseText.evalJSON());
            }
        })
    },
    
    dial: function() {
        var info = Call.getNumber() == undefined ? 'Can not dial this number' : Call.getNumber().toString();
        alert(info);
    },
    
    initPlaybackDialog: function() {
        
    },
    
    initApproveNumberDialog: function(field) {
        
    }
})