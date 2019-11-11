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
                        <?php
                        if (isset($update_data) && $update_data['update_flag'] == 1) {
                            ?>
                            <input type="hidden" name="postId" class="postId" value="<?php echo $update_data['id']; ?>">
                        <?php
                        }
                        ?>
                        <input type="text" name="postName" id="postName" class="form-control postName" placeholder="post Name" value="<?php if (isset($update_data) && $update_data['update_flag'] == 1) {
                                                                                                                                            echo $update_data['post_name'];
                                                                                                                                        } ?>"><br><br>
                        <textarea name="postMessage" id="postMessage" class="form-control postMessage" placeholder="Type your Post here.."><?php if (isset($update_data) && $update_data['update_flag'] == 1) {
                                                                                                                                                echo $update_data['post_message'];
                                                                                                                                            } ?></textarea><br><br>
                        <input type="text" name="slug" id="slug" class="form-control slug" placeholder="Tags" value="<?php if (isset($update_data) && $update_data['update_flag'] == 1) {
                                                                                                                            echo $update_data['post_tags'];
                                                                                                                        } ?>">
                    </form>
                </div>
                <div class="card-footer">
                    <?php
                    if (isset($update_data) && $update_data['update_flag'] == 1) {
                        ?>
                        <input type="button" class="btn btn-sm btn-info editPost" id="editPost" value="Edit Post">
                    <?php
                    } else {
                        ?>
                        <input type="button" class="btn btn-sm btn-primary createPost" id="createPost" value="Create Post">
                    <?php
                    }
                    ?>
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
                    <th> Edit </th>
                    <th> Delete </th>
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
                            <td> <a class="btn btn-sm btn-info editPost" href="<?php echo base_url() . "blog/edit_post/" . $post->id; ?>"> Edit </a></td>
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


    $(document).on('click', '.editPost', function() {

        var id = $(document).find('.postId').val();
        var post_name = $(document).find('.postName').val();
        var post_message = $(document).find('.postMessage').val();
        var post_tags = $(document).find('.slug').val();

        $.ajax({
            url: '<?php echo base_url() . "blog/update_post" ?>',
            type: 'post',
            data: {
                id,
                post_name,
                post_message,
                post_tags
            },
            dataType : 'json',
            success: function(response) {
                var data = response;
                console.log(data.success);
                if (data.success) {
                    alert(data.message);
                    window.location.href = "<?php echo base_url() . "blog"; ?>";
                }
            },
            error: function(response) {
                console.error(response);
                window.location.href = "<?php echo base_url() . "blog"; ?>";
            }
        });

    });
</script>