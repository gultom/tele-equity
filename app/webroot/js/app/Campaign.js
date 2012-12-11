
var Campaign = new Class.create({
    
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    initAddDialog: function() {
        jQuery("#addCampaignDialog").dialog("open");
        new Ajax.Request(Functions.getAppAddress() + 'campaigns/add', {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('addCampaignDialog', response.responseText);
            }
        })
    },
    
    initEditDialog: function() {
        jQuery("#editCampaignDialog").dialog("open");
    }
})