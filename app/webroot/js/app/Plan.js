
var Plan = Class.create({
    id: null,
    
    setId: function(id) {
        this.id = id ? id : 0;
    },
    
    getId: function() {
        return this.id;
    },
    
    listPlan: function() {
        jQuery("#PolicyPlanId option").each(function() {
            jQuery(this).remove();
        });
        new Ajax.Request(Functions.getAppAddress() + 'plans/listplan/' + Product.getId(), {
            method: 'get',
            onSuccess: function(response) {
                jQuery("#PolicyPlanId").append(new Option('(choose one)', ''));
                jQuery.each(response.responseText.evalJSON(), function (key, value) {
                    jQuery('#PolicyPlanId').append(jQuery('<option>', {
                        value : key
                    }).text(value));
                })
                Plan.setId(jQuery('#PolicyCurrentPlanId').val());
                jQuery('#PolicyPlanId').val(Plan.getId());
            }
        })
    }
})