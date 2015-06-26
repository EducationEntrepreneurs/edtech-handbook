function votecount(postid,IPAddr,status){
        jQuery.ajax({
            type: "POST",
            url: "../wp-admin/admin-ajax.php",
            data: {
                action: 'vote_count',
                postId: postid,
                IP: IPAddr,
                VoteStatus: status
            },
            success: function (response) {
              jQuery('.vote_answer').html(response);
              
              },
            error: function () {
              jQuery('.vote_answer').html('Oops!! Something went wrong!! Try later!');
            }
        });
}
