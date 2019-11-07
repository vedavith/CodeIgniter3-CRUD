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
    </div><br>
    <div class="container row">
        <table class="table">
            <thead>
                <tr>
                    <th> S.No </th>
                    <th> Title </th>
                    <th> Body </th>
                    <th> Tags </th>
                    <th> Created On </th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($get_posts->num_rows() > 0) {
                    $count = 1;
                    foreach ($get_posts->result() as $post) {
                        ?>
                        <tr>
                            <td> <?php echo $count; ?> </td>
                            <td> <?php echo $post->post_name; ?> </td>
                            <td> <?php echo $post->post_message; ?> </td>
                            <td> <?php echo $post->post_tags; ?> </td>
                            <td> <?php echo $post->created_on; ?> </td>
                            <td> <input type="button" class="btn btn-sm btn-danger deletePost" value="Delete" data-id="<?php echo $post->id; ?>"> </td>
                        </tr>
                <?php
                        $count++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div><br><br><br>
</section>

<script>
    $(document).ready(function() {
        $(document).on('click', '.createPost', function() {
            var post_name = $(document).find('.postName').val();
            var post_message = $(document).find('.postMessage').val();
            var post_tags = $(document).find('.slug').val();

            $.ajax({
                url: '<?php echo base_url(); ?>/blog/insert_post',
                method: 'post',
                data: {
                    post_name,
                    post_message,
                    post_tags
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        window.location.href = '<?php echo base_url(); ?>blog';
                    }
                },
                error: function(response) {
                    console.error(request);
                }
            });
        });

        $(document).on('click', '.deletePost', function() {
            if (confirm('Are you sure ?')) {
                var getId = $(this).data('id');
                $.ajax({
                    url: '<?php echo base_url(); ?>/blog/delete_post',
                    method: 'post',
                    data: {
                        id: getId
                    },
                    dataType: 'json',
                    success: function(response) {
                        var data = response;
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '<?php echo base_url(); ?>blog';
                        }
                    },
                    error: function(response) {
                        console.error(response);
                    }
                });
            }
        });
    });
</script>