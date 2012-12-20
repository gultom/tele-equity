
var Policy = Class.create ({
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    initPolicyTabs: function() {
        Functions.initDialog('addPolicyDialog', 'Form Tertanggung', 680, 530);
        Functions.initDialog('editPolicyDialog', 'Form Tertanggung', 680, 530);
    },
    
    initAddDialog: function() {
        jQuery('#addPolicyDialog').dialog('open');
        new Ajax.Request(Functions.getAppAddress() + 'policy/tabs', {
            asynchronous: false,
            method: 'get',
            onSuccess: function(response) {
                Functions.write('addPolicyDialog', response.responseText);
                jQuery('#policyTabs').tabs();
            }
        })
    },
    
    checkId: function(fn) {
        if (Policy.getId() === null) {
            jQuery('#policyTabs').tabs({
                activate: function() {
                    jQuery('#policyTabs').tabs('option', 'active', 0);
                }
            })
        }
        else
            fn();
    },
    
    loadPlan: function() {
        alert('plan');
    }
})