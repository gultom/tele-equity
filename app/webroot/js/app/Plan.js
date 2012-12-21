
var Plan = Class.create({
    id: null,
    
    setId: function(id) {
        this.id = id;
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
            }
        })
    }
})