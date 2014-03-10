window.addEvent('domready', function() {
    $$('.like').addEvent('click', function() {
        var elemId = this.id;
        id = elemId.split('_');
        var jsonRequest = new Request.JSON({
        url: "/lib/ajax_logic.php",
        onComplete: function(result){
            if (result.message == 'error') {
                alert('Already Liked!');
            }else if (result.message == 'ok') {
                if (id[1] == 'like') {
                    var newId = id[0] + '_unlike_' + id[2];
                    $(elemId).set('id', newId);
                    $(newId).set('text', 'UnLike');
                    //$(elemId).fade('in');
                    //$(id[0] + 'unlike' + id[2]).setStyle('display', 'block');
                    //$(id).fade('out');
                } else if (id[1] == 'unlike') {
                    var newId = id[0] + '_like_' + id[2];
                    $(elemId).set('id', newId);
                    $(newId).set('text', 'Like');
                    //this.id.setStyle('display', 'none');
                    //this.id.fade('in');
                    //$(id[0] + 'like' + id[2]).setStyle('display', 'block');
                    //$(id).fade('out');
                }
            }
        }}).get({'action': id[1], 'parent_id': id[2], 'parent_type' : id[0], 'format':'json'});
    })


})