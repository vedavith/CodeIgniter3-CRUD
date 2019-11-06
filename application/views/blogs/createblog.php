<br><br><br><br>
<section class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4> Blog Post </h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <input type="text" name="postName" id="#postName" class="form-control postName" placeholder="post Name"><br><br>
                        <textarea name="postMessage" id="#postMessage" class="form-control postMessage" placeholder="Type your Post here.."></textarea><br><br>
                        <input type="text" name="slug" id="slug" class="form-control slug" placeholder="Tags">
                    </form>
                </div>
                <div class="card-footer">
                    <input type="button" class="btn btn-sm btn-primary createPost" id="createPost" value="Create Post">
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $(document).on('click', '.createPost', function() {
            var post_name = $(document).find('.postName').val();
            var post_message = $(document).find('.postMessage').val();
            var post_tags = $(document).find('.slug').val();

            $.ajax({
                url : '<?php echo base_url(); ?>/blog/insert_post',
                method : 'post',
                data : {post_name,post_message,post_tags},
                dataType : 'json',
                success : function(response){
                    if(response.success)
                    {
                        window.location.href = '<?php echo base_url();?>blog';
                    }
                },
                error : function(response){
                    console.error(request);
                }
            });
        });
    });
</script>