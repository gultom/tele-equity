
var UserGroup = Class.create({
    
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    checkType: function(type) {
        jQuery("#UserGroupUserId").find('option').remove().end();
        new Ajax.Request(Functions.getAppAddress() + 'userGroups/listleaders/' + type, {
            method: 'get',
            onSuccess: function(response) {
                if (type != '') {
                    jQuery("#UserGroupUserId").append(new Option('(Choose One)', ''));
                    jQuery.each(response.responseText.evalJSON(), function (key , value) {
                        jQuery("#UserGroupUserId").append(jQuery('<option>', {
                            value : key
                        }).text(value));
                    })
                }
            }
        })
    },
    
    initShowGroupsDialog: function() {
        jQuery("#groupsDialog").dialog("open");
        new Ajax.Request (Functions.getAppAddress() + 'userGroups/view', {
            method: 'get',
            onSuccess: function(response) {
                Functions.write("groupsDialog", response.responseText);
                UserGroup.load();
            }
        })
    },
    
    load: function() {
        new Ajax.Request(Functions.getAppAddress() + 'userGroups/load', {
            method: 'get',
            onLoading: function() {
                Functions.write('groupList', '');
                jQuery("#groupList").append('<div id="loadingImage"></div>');
                Functions.write('loadingImage', '<img src="' + Functions.getAppAddress() + 'img/loading.gif' + '" />');
                jQuery("#loadingImage").css('text-align', 'center');
            },
            onSuccess: function(response) {
                Functions.write('groupList', response.responseText);
                Functions.initDatatable('groupsDatatable', 100);
                Functions.initDialog("addGroupDialog", "Add Group", 380, 230);
                Functions.initDialog("editGroupDialog", "Edit Group", 380, 230);
            }
        })
    },
    
    initAddDialog: function() {
        jQuery("#addGroupDialog").dialog("open");
        new Ajax.Request(Functions.getAppAddress() + 'userGroups/add', {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('addGroupDialog', response.responseText);
                UserGroup.validate('UserGroupAdd');
            }
        })
    },
    
    validate: function(formId) {
        jQuery("#" + formId.toString()).validate({
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
                'data[UserGroup][name]':  {
                    required: true
                },
                'data[UserGroup][type]': {
                    required: true
                },
                'data[UserGroup][user_id]': {
                    required: true
                }
            },
            submitHandler: function() {
                (formId.toString() === 'UserGroupAdd') ? UserGroup.add() : UserGroup.edit();
            }
        })
    },
    
    add: function() {
        new Ajax.Request(Functions.getAppAddress() + 'userGroups/add', {
            method: 'post',
            parameters: Form.serialize('UserGroupAdd'),
            onSuccess: function(response) {
                if (response.responseText == 'true') {
                    jQuery("#addGroupDialog").dialog("close");
                    UserGroup.load();
                }
                else {
                    Functions.write('addGroupInfo', 'Failed to add new Group');
                    jQuery('#addGroupInfo').addClass('error');
                    jQuery('#addGroupInfo').css('text-align', 'center');
                }
            }
        })
    },
    
    initEditDialog: function() {
        jQuery("#editGroupDialog").dialog("open");
        new Ajax.Request(Functions.getAppAddress() + 'userGroups/edit', {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('editGroupDialog', response.responseText);
            }
        })
    },
    
    edit: function() {
        alert('edit');
    }
});