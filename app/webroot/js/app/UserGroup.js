
var UserGroup = Class.create({
    
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
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
            }
        })
    },
    
    add: function() {
        
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
            submitHandler: function() {
                (formId.toString() === 'GroupAdd') ? UserGroup.add() : UserGroup.edit();
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
        
    }
});