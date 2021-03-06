$(document).ready(function() {
  $(".chosen-select").chosen({width: '100%'});

  $(".chosen-select").on('change', function(evt, params) {
    var action = null;
    var uid = null;
    if ( typeof params.selected != 'undefined') {
      action = 'assign';
      uid = params.selected;
      submit_data();
    } else if ( typeof params.deselected != 'undefined') {
      action = 'unassign';
      uid = params.deselected;
      
      confirmBox("Are you sure you want to unassign this agent?", {
        title: 'Unassign agent',
        confirm: 'Unassign',
        
        onConfirm: function(){
          submit_data();
        },
        onCancel: function(){
          agent_assign_revert(action, uid);
        }
      });
      
    } else {
      // Nothing to do here.
      return false;
    }
    
    function submit_data() {
      var submit_url = $('#assign-agents').attr('action');
      var CSRF_token = $('#assign-agents input[name=csrf_aw_datacollection]').val();
  
      // Submit data
      $.post(submit_url, {
        uid : uid,
        action : action,
        csrf_aw_datacollection : CSRF_token
      }, function(res) {
        if (typeof res.status == 'undefined' || res.status.code != 200) {
          console.log('Agent ' + action + ' failed. Response follows.');
          console.log(res);
          // TODO: Replace alert.
          alert('An error occurred. Try again later.');
          agent_assign_revert(action, uid);
        }
      }).fail(function(res) {
        console.log('Agent ' + action + ' failed. Response follows.');
        console.log(res);
        // TODO: Replace alert.
        alert('An error occurred. Try again later.');
        agent_assign_revert(action, uid);
      });
    }

    function agent_assign_revert(action, uid) {
      var $opt = $(".chosen-select option[value=" + uid + "]");
      if (action == 'assign') {
        $opt.prop("selected", false);
      } else {
        $opt.prop("selected", true);
      }
      $(".chosen-select").trigger('chosen:updated');
    }

  });
});
