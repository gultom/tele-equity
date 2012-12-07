
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
                Functions.initDatatable('usersDatatable', 120);
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
        User.setId(null);
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
    
    checkLevel: function(id) {
        jQuery("#UserGroupId").prop('disabled', true);
        jQuery("#UserGroupId option").each(function() {
            jQuery(this).remove();
        });
            
        jQuery("#UserQaId").prop('disabled', true);
        jQuery("#UserQaId option").each(function() {
            jQuery(this).remove();
        });
            
        if (id !== '' && (jQuery.inArray(parseInt(id), new Array(7, 8)) > -1)) {
            var type = (id == 7) ? 1 : 0; 
            jQuery("#UserGroupId").prop('disabled', false);
            jQuery("#UserGroupId").find('option').remove().end();
            jQuery("#UserQaId").find('option').remove().end();
            new Ajax.Request(Functions.getAppAddress() + 'userGroups/lists/' + type, {
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
            
            if (id == 8) {
                jQuery("#UserQaId").prop('disabled', false);
                new Ajax.Request(Functions.getAppAddress() + 'users/getuserbylevel/5', {
                    asynchronous: false,
                    method: 'get',
                    onSuccess: function(response) {
                        jQuery("#UserQaId").append(new Option('(Choose One)', ''));
                        jQuery.each(response.responseText.evalJSON(), function (key, value) {
                            jQuery("#UserQaId").append(jQuery('<option>', {
                                value : key
                            }).text(value));
                        });
                    }
                });
            }
        }
    },
    
    validate: function(formId) {
        jQuery.validator.addMethod("usernameExist", function(value, element) {
            var isExist;
            new Ajax.Request (Functions.getAppAddress() + 'users/isusernameexist', {
                asynchronous: false,
                method: 'post',
                parameters: 'username=' + value + '&id=' + User.getId(),
                onSuccess: function(response) {
                    isExist = (response.responseText === 'true') ? false : true;
                }
            });
            return isExist;
        }, 'Username is already taken');
        
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
                'data[User][username]':  {
                    required: true,
                    usernameExist: true
                },
                'data[User][level_id]': {
                    required: true
                }
            },
            messages: {
                'data[User][username]': {
                    required: 'Please fill username',
                    usernameExist: 'Username already exist'
                },
                'data[User][level_id]': {
                    required: 'Please choose user level'
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
        if (User.getId() === null) {
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
                    jQuery("#UserQaId").val(jQuery("#UserCurrentQa").val());
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