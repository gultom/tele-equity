
var User = Class.create({
    
    id: null,
    
    setId: function(id) {
        this.id = id;
    },
    
    getId: function() {
        return this.id;
    },
    
    load: function() {
        new Ajax.Request(Functions.getAppAddress() + 'users/view', {
            method: 'get',
            onLoading: function() {
                Functions.write('userList', '');
                jQuery("#userList").append('<div id="loadingImage"></div>');
                Functions.write('loadingImage', '<img src="' + Functions.getAppAddress() + 'img/loading.gif' + '" />');
                jQuery("#loadingImage").css('text-align', 'center');
            },
            onSuccess: function(response) {
                Functions.write('userList', response.responseText);
                Functions.initDatatable('usersDatatable', 115);
            }
        })
    },
    
    initLogoutDialog: function() {
        jQuery("#logoutDialog").dialog("open");
    },
    
    logout: function() {
        jQuery("#logoutDialog").dialog("close");
        Functions.redirect(Functions.getAppAddress() + 'users/logout');
    },
    
    initAddDialog: function() {
        jQuery("#addUserDialog").dialog("open");
        new Ajax.Request(Functions.getAppAddress() + 'users/add', {
            method: 'get',
            onSuccess: function(response) {
                Functions.write('addUserDialog', response.responseText);
                Functions.initCalendar("joinDate");
                User.validate('UserAdd');
            }
        });
    },
    
    checkLevel: function(code) {
        if (code !== '' && code == 8) {
            jQuery("#UserGroupId").prop('disabled', false);
            new Ajax.Request(Functions.getAppAddress() + 'usergroups/lists', {
                asynchronous: false,
                method: 'get',
                onSuccess: function(response) {
                    jQuery("#UserGroupId").append(new Option('(Choose One)', ''));
                    jQuery.each(response.responseText.evalJSON(), function (key, value) {
                        jQuery("#UserGroupId").append(jQuery('<option>', {
                            value : key
                        }).text(value));
                    });
                }
            })
            
            jQuery("#UserQaUsername").prop('disabled', false);
            new Ajax.Request(Functions.getAppAddress() + 'users/getuserbylevel/5', {
                asynchronous: false,
                method: 'get',
                onSuccess: function(response) {
                    jQuery("#UserQaUsername").append(new Option('(Choose One)', ''));
                    jQuery.each(response.responseText.evalJSON(), function (key, value) {
                        jQuery("#UserQaUsername").append(jQuery('<option>', {
                            value : key
                        }).text(value));
                    });
                }
            });
        }
        else {
            jQuery("#UserGroupId").prop('disabled', true);
            jQuery("#UserGroupId option").each(function() {
                jQuery(this).remove();
            });
            
            jQuery("#UserQaUsername").prop('disabled', true);
            jQuery("#UserQaUsername option").each(function() {
                jQuery(this).remove();
            });
            
        }
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
                'data[User][username]':  {
                    required: true
                },
                'data[User][level_code]': {
                    required: true
                }
            },
            messages: {
                'data[User][username]': {
                    messages: 'Please fill username'
                }
            },
            submitHandler: function() {
                (formId.toString() === 'UserAdd') ? User.add() : User.edit();
            }
        });
    },
    
    add: function() {
        new Ajax.Request(Functions.getAppAddress() + 'users/add', {
            method: 'post',
            parameters: Form.serialize("UserAdd"),
            onSuccess: function(response) {
                if (response.responseText === 'true') {
                    jQuery("#addUserDialog").dialog("close");
                    User.load();
                }
                else {
                    Functions.write('addInfo', 'Failed to add new User. Please try again later.');
                    jQuery('#addInfo').addClass('error');
                    jQuery('#addInfo').css('text-align', 'center');
                }
            }
        })
    },
    
    initEditDialog: function() {
        if (this.id === null) {
            Functions.write('userInfo', '<b>Please select user first.</b>');
            Functions.initInformationDialog('userInfo', 300, 125);
            jQuery("#userInfo").dialog('open');
        }
        else {
            jQuery("#editUserDialog").dialog("open");
            new Ajax.Request(Functions.getAppAddress() + 'users/edit/' + User.getId(), {
                method: 'get',
                onSuccess: function(response) {
                    Functions.write('editUserDialog', response.responseText);
                    Functions.initCalendar("joinDate");
                    User.validate('UserEdit');
                    User.checkLevel(jQuery("#UserLevelId option:selected").val());
                    jQuery("#UserGroupId").val(jQuery("#UserCurrentGroup").val());
                    jQuery("#UserQaUsername").val(jQuery("#UserCurrentQa").val());
                }
            });
        }
    },
    
    edit: function() {
        new Ajax.Request(Functions.getAppAddress() + 'users/edit/', {
            method: 'post',
            parameters: Form.serialize("UserEdit"),
            onSuccess: function(response) {
                if (response.responseText === 'true') {
                    jQuery("#editUserDialog").dialog("close");
                    User.load();
                }
                else {
                    Functions.write('editInfo', 'Failed to add new User. Please try again later.');
                    jQuery('#editInfo').addClass('error');
                    jQuery('#editInfo').css('text-align', 'center');
                }
            }
        });
    },
    
    initDeleteDialog: function() {
        Functions.write('deleteUserDialog', 'Are you sure want to delete this user ?');
        jQuery("#deleteUserDialog").dialog("open");
    },
    
    del: function() {
        new Ajax.Request(Functions.getAppAddress() + 'users/delete/' + User.getId(), {
            method: 'post',
            onSuccess: function(response) {
                if (response.responseText === 'true') {
                    jQuery("#userInfo").addClass("error");
                    jQuery("#userInfo").css('text-align', 'center');
                    jQuery("#userInfo").css('display', 'block');
                    Functions.write('userInfo', 'User has been successfully deleted.');
                    jQuery("#userInfo").fadeOut(8000);
                    User.load();
                }
                else {
                    Functions.write('userInfo', 'Failed to delete user');
                }
            }
        })
    }
});