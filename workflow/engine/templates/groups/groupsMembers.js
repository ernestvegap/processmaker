/*
 * @author: Qennix
 * Jan 27th, 2011
 */

//Keyboard Events
new Ext.KeyMap(document, {
	 key: Ext.EventObject.F5,
     fn: function(keycode, e) {
    	if (! e.ctrlKey) {
    		if (Ext.isIE) {
            // IE6 doesn't allow cancellation of the F5 key, so trick it into
            // thinking some other key was pressed (backspace in this case)
    			e.browserEvent.keyCode = 8;
    		}
    		e.stopEvent();
    		document.location = document.location;
    	}else{
    		Ext.Msg.alert('Refresh', 'You clicked: CTRL-F5');
    	}
    }
});

var storeP;
var storeA;
var cmodelP;
var smodelA;
var smodelP;

var availableGrid;
var assignedGrid;

var MembersPanel;
var viewport;

var assignButton;
var assignAllButton;
var removeButton;
var removeAllButton;
var backButton;


Ext.onReady(function(){
	
	assignAllButton = new Ext.Action({
    	text: TRANSLATIONS.ID_ASSIGN_ALL_MEMBERS,
    	iconCls: 'button_menu_ext ss_sprite  ss_add',
    	handler: AssignAllUsersAction
    });
	
	removeAllButton = new Ext.Action({
    	text: TRANSLATIONS.ID_REMOVE_ALL_MEMBERS,
    	iconCls: 'button_menu_ext ss_sprite  ss_delete',
    	handler: RemoveAllUsersAction
    });
	
	backButton = new Ext.Action({
		text: TRANSLATIONS.ID_BACK,
		iconCls: 'button_menu_ext ss_sprite ss_arrow_redo',
		handler: BackToGroups
	});
	
	storeP = new Ext.data.GroupingStore( {
        proxy : new Ext.data.HttpProxy({
            url: 'groups_Ajax?action=assignedMembers&gUID=' + GROUPS.GRP_UID
          }),
    	reader : new Ext.data.JsonReader( {
    		root: 'members',
    		fields : [
    		    {name : 'USR_UID'},
    		    {name : 'USR_USERNAME'},
    		    {name : 'USR_FIRSTNAME'},
    		    {name : 'USR_LASTNAME'},
    		    {name : 'USR_EMAIL'}
    		]
    	})
    });
	
	searchTextA = new Ext.form.TextField ({
        id: 'searchTextA',
        ctCls:'pm_search_text_field',
        allowBlank: true,
        width: 110,
        emptyText: TRANSLATIONS.ID_ENTER_SEARCH_TERM,
        listeners: {
          specialkey: function(f,e){
            if (e.getKey() == e.ENTER) {
            	DoSearchA();
            }
          }
        }
    });
	
	clearTextButtonA = new Ext.Action({
    	text: 'X',
    	ctCls:'pm_search_x_button',
    	handler: GridByDefaultA
    });
	
	searchTextP = new Ext.form.TextField ({
        id: 'searchTextP',
        ctCls:'pm_search_text_field',
        allowBlank: true,
        width: 110,
        emptyText: TRANSLATIONS.ID_ENTER_SEARCH_TERM,
        listeners: {
          specialkey: function(f,e){
            if (e.getKey() == e.ENTER) {
            	DoSearchP();
            }
          }
        }
    });
	
	clearTextButtonP = new Ext.Action({
    	text: 'X',
    	ctCls:'pm_search_x_button',
    	handler: GridByDefaultP
    });
	
	storeA = new Ext.data.GroupingStore( {
        proxy : new Ext.data.HttpProxy({
            url: 'groups_Ajax?action=availableMembers&gUID=' + GROUPS.GRP_UID
          }),
    	reader : new Ext.data.JsonReader( {
    		root: 'members',
    		fields : [
    		    {name : 'USR_UID'},
    		    {name : 'USR_USERNAME'},
    		    {name : 'USR_FIRSTNAME'},
    		    {name : 'USR_LASTNAME'},
    		    {name : 'USR_EMAIL'}
    		    ]
    	})
    });
	
	cmodelP = new Ext.grid.ColumnModel({
        defaults: {
            width: 50,
            sortable: true
        },
        columns: [
            {id:'USR_UID', dataIndex: 'USR_UID', hidden:true, hideable:false},
            {header: TRANSLATIONS.ID_LAST_NAME, dataIndex: 'USR_LASTNAME', width: 60, align:'left'},
            {header: TRANSLATIONS.ID_FIRST_NAME, dataIndex: 'USR_FIRSTNAME', width: 60, align:'left'},
            {header: TRANSLATIONS.ID_USER_NAME, dataIndex: 'USR_USERNAME', width: 60, align:'left'}
        ]
    });
	
	smodelA = new Ext.grid.RowSelectionModel({
		selectSingle: false,
		listeners:{
			selectionchange: function(sm){
    			switch(sm.getCount()){
    			case 0: Ext.getCmp('assignButton').disable(); break;
    			default: Ext.getCmp('assignButton').enable(); break;	
    			}
    		}
		}
	});
	
	smodelP = new Ext.grid.RowSelectionModel({
		selectSingle: false,
		listeners:{
			selectionchange: function(sm){
    			switch(sm.getCount()){
    			case 0: Ext.getCmp('removeButton').disable(); break;
    			default: Ext.getCmp('removeButton').enable(); break;	
    			}
    		}
		}
	});
	
  	availableGrid = new Ext.grid.GridPanel({
  		    layout			: 'fit',
  		    region          : 'center',
        	ddGroup         : 'assignedGridDDGroup',
            store           : storeA,
            cm          	: cmodelP,
            sm				: smodelA,
            enableDragDrop  : true,
            stripeRows      : true,
            autoExpandColumn: 'USR_USERNAME',
            iconCls			: 'icon-grid',
            id				: 'availableGrid',
        	height			: 100,
        	autoWidth 		: true,
        	stateful 		: true,
        	stateId 		: 'grid',
        	enableColumnResize : true,
        	enableHdMenu	: true,
        	frame			: false,
        	columnLines		: false,
        	viewConfig		: {forceFit:true},
            tbar: [TRANSLATIONS.ID_AVAILABLE_MEMBERS,{xtype: 'tbfill'},'-',searchTextA,clearTextButtonA],
            bbar: [{xtype: 'tbfill'}, assignAllButton],
            listeners: {rowdblclick: AssignUsersAction} 
    });

  	assignedGrid = new Ext.grid.GridPanel({
  		    layout			: 'fit',
  			ddGroup         : 'availableGridDDGroup',
            store           : storeP,
            cm          	: cmodelP,
            sm				: smodelP,
            enableDragDrop  : true,
            stripeRows      : true,
            autoExpandColumn: 'USR_USERNAME',
            iconCls			: 'icon-grid',
            id				: 'assignedGrid',
        	height			: 100,
        	autoWidth 		: true,
        	stateful 		: true,
        	stateId 		: 'grid',
        	enableColumnResize : true,
        	enableHdMenu	: true,
        	frame			: false,
        	columnLines		: false,
        	viewConfig		: {forceFit:true},
            tbar: [TRANSLATIONS.ID_ASSIGNED_MEMBERS,{xtype: 'tbfill'},'-',searchTextP,clearTextButtonP],
            bbar: [{xtype: 'tbfill'},removeAllButton],
        	listeners: {rowdblclick: RemoveUsersAction} 
    });
  	
  	buttonsPanel = new Ext.Panel({
	    width	 	 : 40,
		layout       : {
            type:'vbox',
            padding:'0',
            pack:'center',
            align:'center'
        },
        defaults:{margins:'0 0 35 0'},
        items:[
               {xtype:'button',text: '>>', handler: AssignUsersAction, id: 'assignButton', disabled: true},
               {xtype:'button',text: '<<', handler: RemoveUsersAction, id: 'removeButton', disabled: true}
               ]
    });
  	
  	RefreshMembers();

  	//MEMBERS DRAG AND DROP PANEL
    MembersPanel = new Ext.Panel({
    	    region		 : 'center',
    		autoWidth	 : true,
    		layout       : 'hbox',
   		    defaults     : { flex : 1 }, //auto stretch
    		layoutConfig : { align : 'stretch' },
    		items        : [availableGrid,buttonsPanel,assignedGrid],
    		viewConfig	 : {forceFit:true},
    		tbar: [TRANSLATIONS.ID_GROUPS + ' : ' + GROUPS.GRP_TITLE ,{xtype: 'tbfill'},backButton]

    });
   
    //LOAD ALL PANELS
    viewport = new Ext.Viewport({
    	layout: 'fit',
    	items: [MembersPanel]
    });
    
    DDLoadUsers();  //Load DND functionality
    
});

//Do Nothing Function
DoNothing = function(){}

//Return to Groups Main Page
BackToGroups = function(){
	location.href = 'groups';
}

//Loads Drag N Drop Functionality for Users
DDLoadUsers = function(){
	//MEMBERS DRAG N DROP AVAILABLE
	var availableGridDropTargetEl =  availableGrid.getView().scroller.dom;
    var availableGridDropTarget = new Ext.dd.DropTarget(availableGridDropTargetEl, {
                    ddGroup    : 'availableGridDDGroup',
                    notifyDrop : function(ddSource, e, data){
                            var records =  ddSource.dragData.selections;
                            var arrAux = new Array();
                            for (var r=0; r < records.length; r++){
                            	arrAux[r] = records[r].data['USR_UID'];
                            }
                            DeleteGroupsUser(arrAux,RefreshMembers,FailureProcess);
                            return true;
                    }
    });
	
    //MEMBERS DRAG N DROP ASSIGNED
    var assignedGridDropTargetEl = assignedGrid.getView().scroller.dom;
    var assignedGridDropTarget = new Ext.dd.DropTarget(assignedGridDropTargetEl, {
                    ddGroup    : 'assignedGridDDGroup',
                    notifyDrop : function(ddSource, e, data){
                            var records =  ddSource.dragData.selections;
                            var arrAux = new Array();
                            for (var r=0; r < records.length; r++){
                            	arrAux[r] = records[r].data['USR_UID'];
                            }
                            SaveGroupsUser(arrAux,RefreshMembers,FailureProcess);
                            return true;
                    }
     });
}

//REFRESH GROUPS GRIDS
RefreshMembers = function(){
	DoSearchA();
	DoSearchP();
}

//FAILURE AJAX FUNCTION
FailureProcess = function(){
	Ext.Msg.alert(TRANSLATIONS.ID_GROUPS, TRANSLATIONS.ID_MSG_AJAX_FAILURE);
}

//ASSIGN GROUPS TO A USER
SaveGroupsUser = function(arr_usr, function_success, function_failure){
	var sw_response;
	viewport.getEl().mask(TRANSLATIONS.ID_PROCESSING);
	Ext.Ajax.request({
		url: 'groups_Ajax',
		params: {action: 'assignUsersToGroupsMultiple', GRP_UID: GROUPS.GRP_UID, USR_UID: arr_usr.join(',')},
		success: function(){
					function_success();
					viewport.getEl().unmask();
				  },
		failure: function(){
					function_failure();
					viewport.getEl().unmask();
		}
	});
}

//REMOVE USERS FROM A GROUP
DeleteGroupsUser = function(arr_usr, function_success, function_failure){
	var sw_response;
	viewport.getEl().mask(TRANSLATIONS.ID_PROCESSING);
	Ext.Ajax.request({
		url: 'groups_Ajax',
		params: {action: 'deleteUsersToGroupsMultiple', GRP_UID: GROUPS.GRP_UID, USR_UID: arr_usr.join(',')},
		success: function(){
			        function_success();
					viewport.getEl().unmask();			        
		},
		failure: function(){
					function_failure();
					viewport.getEl().unmask();
		}
	});
}

//AssignButton Functionality
AssignUsersAction = function(){
	rowsSelected = availableGrid.getSelectionModel().getSelections();
	var arrAux = new Array();
	for(var a=0; a < rowsSelected.length; a++){
		arrAux[a] = rowsSelected[a].get('USR_UID');
	}
	SaveGroupsUser(arrAux,RefreshMembers,FailureProcess);
}

//RemoveButton Functionality
RemoveUsersAction = function(){
	rowsSelected = assignedGrid.getSelectionModel().getSelections();
	var arrAux = new Array();
	for(var a=0; a < rowsSelected.length; a++){
		arrAux[a] = rowsSelected[a].get('USR_UID');
	}
	DeleteGroupsUser(arrAux,RefreshMembers,FailureProcess);
}

//AssignALLButton Functionality
AssignAllUsersAction = function(){
	var allRows = availableGrid.getStore();
	var arrAux = new Array();
	if (allRows.getCount()>0){
		for (var r=0; r < allRows.getCount(); r++){
			row = allRows.getAt(r);
			arrAux[r] = row.data['USR_UID'];
		}
		SaveGroupsUser(arrAux,RefreshMembers,FailureProcess);
	}
}

//RevomeALLButton Functionality
RemoveAllUsersAction = function(){
	var allRows = assignedGrid.getStore();
	var arrAux = new Array();
	if (allRows.getCount()>0){
		for (var r=0; r < allRows.getCount(); r++){
			row = allRows.getAt(r);
			arrAux[r] = row.data['USR_UID'];
		}
		DeleteGroupsUser(arrAux,RefreshMembers,FailureProcess);
	}
}

//Function DoSearch Available
DoSearchA = function(){
	availableGrid.store.load({params: {textFilter: searchTextA.getValue()}});
}

//Function DoSearch Assigned
DoSearchP = function(){
	assignedGrid.store.load({params: {textFilter: searchTextP.getValue()}});
}

//Load Grid By Default Available Members
GridByDefaultA = function(){
	searchTextA.reset();
	availableGrid.store.load();
}

//Load Grid By Default Assigned Members
GridByDefaultP = function(){
	searchTextP.reset();
	assignedGrid.store.load();
}