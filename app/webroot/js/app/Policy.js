
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
                Policy.initAddForm();
            }
        })
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
        else
            fn();
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
                    jQuery('#addPolicyDialog', window.parent.document).scrollTop(0);
                }
                else {
                    useClass = 'error';
                    Functions.write('addInfo', 'Failed to add new policy.');
                }
                jQuery('#addInfo').addClass(useClass.toString());
                jQuery('#addInfo').css('text-align', 'center');
                jQuery('#addInfo').css('display', 'block');
                jQuery('#addInfo').fadeOut(8000);            }
        });
    },
    
    loadPlan: function() {
        
    }
})