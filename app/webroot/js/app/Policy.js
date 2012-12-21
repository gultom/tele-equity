
var Policy = Class.create ({
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    initPolicyTabs: function() {
        Plan = typeof Plan !== 'object' ? new Plan : null;
        Beneficiary = typeof Beneficiary !== 'object' ? new Beneficiary : null;
        Product = typeof Product !== 'object' ? new Product : null;
        Functions.write('totalPremium', Functions.numberFormat(Customer.getTotalPremium(), '', '.', '', 'Rp. ', ''));
        Policy.loadCustomerPolicies();
        Functions.initDialog('addPolicyDialog', 'Form Tertanggung', 680, 530);
        Functions.initDialog('editPolicyDialog', 'Form Tertanggung', 680, 530);
        Functions.initConfirmationDialog('deletePolicyDialog', 'Confirmation', 350, 160, function() {
            Policy.del();
            jQuery('#deletePolicyDialog').dialog('close');
        });
    },
    
    loadCustomerPolicies: function() {
        new Ajax.Request(Functions.getAppAddress() + 'policy/customerpolicies/' + Customer.getId(), {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('customerPolicies', response.responseText);
                Functions.initDatatable('customerPoliciesDatatable', 100, 100);
            }
        })
    },
    
    initAddDialog: function() {
        Policy.setId(null);
        new Ajax.Request(Functions.getAppAddress() + 'policy/tabs', {
            asynchronous: false,
            method: 'get',
            onSuccess: function(response) {
                Functions.write('addPolicyDialog', response.responseText);
                jQuery('#policyTabs').tabs();
                Policy.initAddForm();
            }
        })
        jQuery('#addPolicyDialog').dialog('open');
    },
    
    checkId: function(fn) {
        if (Policy.getId() === null) {
            jQuery('#policyTabs').tabs({
                activate: function() {
                    jQuery('#policyTabs').tabs('option', 'active', 0);
                }
            });
            Functions.write('addInfo', 'Please save new policy before you change tab.');
            jQuery('#addInfo').addClass('error');
            jQuery('#addInfo').css('text-align', 'center');
            jQuery('#addInfo').css('display', 'block');
            jQuery('#addInfo').fadeOut(8000);
        }
        else {
            jQuery('#policyTabs').tabs({
                activate: null
            })
            fn();
        }
    },
    
    initAddForm: function() {
        new Ajax.Request(Functions.getAppAddress() + 'policy/add/' + Customer.getId(), {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('policyForm', response.responseText);
                Functions.initCalendar('PolicyBirthDate');
                Policy.validate('PolicyAdd');
            }
        })
    },
    
    validate: function(formId) {
        jQuery('#' + formId.toString()).validate({
            onkeyup: false,
            errorPlacement: function(error, placement) {
                $(placement).qtip({
                    content: error.text(),
                    show: { when: { event: 'none'}, ready: true },
                    hide: { when: { event: 'unfocus' } },
                    position: {
                      corner: {
                         target: 'topRight',
                         tooltip: 'bottomLeft'
                      }
                   },
                   style: {
                      border: {
                         width: 1,
                         radius: 10
                      },
                      tip: true,
                      name: 'red'
                   }
                });
            },
            rules: {
                'data[Policy][birth_date]': {
                    required: true
                }
            },
            messages: {
                required: 'Please input insured birth date'
            },
            submitHandler: function() {
                formId.toString() === 'PolicyAdd' ? Policy.add() : Policy.edit();
            }
        });
    },
    
    add: function() {
        new Ajax.Request(Functions.getAppAddress() + 'policy/add',{
            method: 'post',
            parameters: Form.serialize('PolicyAdd'),
            onSuccess: function(response) {
                var data = response.responseText.evalJSON(), useClass;
                if (data.result) {
                    useClass = 'info';
                    Functions.write('addInfo', 'Policy has been successfully added.');
                    Policy.setId(data.id);
                }
                else {
                    useClass = 'error';
                    Functions.write('addInfo', 'Failed to add new policy.');
                }
                Policy.loadCustomerPolicies();
                jQuery('#addInfo').addClass(useClass.toString());
                jQuery('#addInfo').css('text-align', 'center');
                jQuery('#addInfo').css('display', 'block');
                jQuery('#addInfo').fadeOut(8000);
                jQuery('#addPolicyDialog', window.parent.document).scrollTop(0);
            }
        });
    },
    
    initEditDialog: function() {
        new Ajax.Request(Functions.getAppAddress() + 'policy/tabs', {
            asynchronous: false,
            method: 'get',
            onSuccess: function(response) {
                Functions.write('editPolicyDialog', response.responseText);
                jQuery('#policyTabs').tabs();
                Policy.initEditForm();
            }
        })
        jQuery('#editPolicyDialog').dialog('open');
    },
    
    initEditForm: function() {
        new Ajax.Request(Functions.getAppAddress() + 'policy/edit/' + Policy.getId(), {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('policyForm', response.responseText);
                Functions.initCalendar('PolicyBirthDate');
                Policy.validate('PolicyEdit');
            }
        })
    },
    
    edit: function() {
        var useClass;
        new Ajax.Request(Functions.getAppAddress() + 'policy/edit', {
            method: 'post',
            parameters: Form.serialize('PolicyEdit'),
            onSuccess: function(response) {
                if (response.responseText === 'true') {
                    useClass = 'info';
                    Functions.write('editInfo', 'Policy has been successfully saved.');
                }
                else {
                    useClass = 'error';
                    Functions.write('editInfo', 'Failed to save policy.');
                }
                Policy.loadCustomerPolicies();
                jQuery('#editInfo').addClass(useClass.toString());
                jQuery('#editInfo').css('text-align', 'center');
                jQuery('#editInfo').css('display', 'block');
                jQuery('#editInfo').fadeOut(8000);
                jQuery('#editPolicyDialog', window.parent.document).scrollTop(0);
            }
        })
    },
    
    initDeleteDialog: function() {
        Functions.write('deletePolicyDialog', 'Are you sure want to delete this policy ?');
        jQuery('#deletePolicyDialog').dialog('open');
    },
    
    del: function() {
        new Ajax.Request(Functions.getAppAddress() + 'policy/delete/' + Policy.getId(), {
            method: 'post',
            onSuccess: function(response) {
                var useClass;
                if (response.responseText === 'true') {
                    useClass = 'info';
                    Functions.write('policyInfo', 'Policy has been deleted.');
                }
                else {
                    useClass = 'error';
                    Functions.write('policyInfo', 'Failed to delete policy.');
                }
                Policy.loadCustomerPolicies();
                jQuery('#policyInfo').addClass(useClass.toString());
                jQuery('#policyInfo').css('text-align', 'center');
                jQuery('#policyInfo').css('display', 'block');
                jQuery('#policyInfo').fadeOut(8000);
            }
        })
    },
    
    loadPlan: function() {
        new Ajax.Request(Functions.getAppAddress() + 'policy/loadplan/' + Policy.getId(), {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('planForm', response.responseText);
            }
        })
    }
})