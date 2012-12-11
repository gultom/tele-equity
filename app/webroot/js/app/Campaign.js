
var Campaign = new Class.create({
    
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    initAddDialog: function() {
        Campaign.setId(null);
        jQuery("#addCampaignDialog").dialog("open");
        new Ajax.Request(Functions.getAppAddress() + 'campaigns/add', {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('addCampaignDialog', response.responseText);
                Campaign.validate('CampaignAdd');
            }
        })
    },
    
    validate: function(formId) {
        jQuery.validator.addMethod("nameExist", function(value, element) {
            var isExist;
            new Ajax.Request(Functions.getAppAddress() + 'campaigns/isnameexist', {
                asynchronous: false,
                method: 'post',
                parameters: 'name=' + value + '&id=' + Campaign.getId(),
                onSuccess: function(response) {
                    isExist = (response.responseText === 'true') ? false : true;
                }
            })
            return isExist;
        }, 'Campaign name already exist');
        
        jQuery("#" + formId.toString()).validate({
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
                'data[Campaign][name]': {
                    required: true,
                    nameExist: true
                }
            },
            messages: {
                'data[Campaign][name]': {
                    required: 'Campaign name cannot be empty',
                    nameExist: 'Campaign name already exist'
                }
            },
            submitHandler: function() {
                (formId.toString() === 'CampaignAdd') ? Campaign.add() : Campaign.edit();
            }
        })
    },
    
    add: function() {
        new Ajax.Request(Functions.getAppAddress() + 'campaigns/add', {
            method: 'post',
            parameters: Form.serialize('CampaignAdd'),
            onSuccess: function(response) {
                if (response.responseText === 'true')
                    Functions.closeDialog('addCampaignDialog');
                else {
                    jQuery('#campaignInfo').addClass('error');
                    jQuery('#campaignInfo').css('text-align', 'center');
                    Functions.write('campaignInfo', 'Failed to add new campaign.');
                }
            }
        })
    },
    
    initEditDialog: function() {
        jQuery("#editCampaignDialog").dialog("open");
    }
})