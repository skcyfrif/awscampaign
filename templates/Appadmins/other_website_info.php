<script type="text/javascript" src="<?php echo HTTP_ROOT . 'js/' ?>jquery-ui.js"></script>
<script type="text/javascript">
//    var jq = $.noConflict();
    $(function() {
        var strURL = '<?php echo HTTP_ROOT; ?>';
        $("#list").sortable({class: 'move', update: function() {
                var order = $('#list').sortable('serialize');
                // alert(order);

                jQuery.ajax({
                    type: 'POST',
                    data: order,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-Token',<?= json_encode($this->request->getParam('_csrfToken')); ?>);
                    },
                    url: '<?= HTTP_ROOT; ?>ajaxs/websiteOrder',

                }).done(function(res) {


                }).fail(function() {
                    alert('Error found. Try again..');
                    return;
                });


//                $.post("<?= HTTP_ROOT; ?>ajaxs/websiteOrder", order, function(theResponse) {
//                });
            }
        });
    });
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Other Website Info</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Other Website Info</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add/Edit Website Info </h3>                        
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?= $this->Form->create('', ['type' => 'file']); ?>                      
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="file_input" class=" form-control-label">Site Url</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="site_url" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->site_url;
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="file_input" class=" form-control-label">Description</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <textarea id="description"  class="form-control" name="site_description" required rows="5"><?php
                                    if (!empty($getData)) {
                                        echo $getData->site_description;
                                    }
                                    ?></textarea>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-success">Submit</button>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Other Website Info </h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Sl. no.</th>
                                    <th>Description</th>
                                    <th>URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                <?php
                                $i = 1;
                                foreach ($allData as $data) {
                                    ?>
                                    <tr  id="arrayorder_<?php echo $data->id; ?>" class="message_box ui-sortable-handle">
                                        <td><i class="fa fa-arrows-alt-v fa-2x"></i></td>
                                        <td valign="middle"><?= $i++; ?></td>
                                        <td valign="middle"><?= $data->site_description; ?></td>
                                        <td valign="middle"><?= $data->site_url; ?></td>
                                        <td valign="middle">
                                            <a href="<?= HTTP_ROOT . 'appadmins/other_website_info/edit/' . $data->id; ?>" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                            <?php if ($data->is_active == 1) { ?>
                                                <a href="<?= HTTP_ROOT . 'appadmins/other_website_info/deactive/' . $data->id; ?>" class="btn btn-info" title="Click to deactive"><i class="fa fa-times"></i></a>
                                            <?php } else { ?>
                                                <a href="<?= HTTP_ROOT . 'appadmins/other_website_info/active/' . $data->id; ?>" class="btn btn-success" title="Click to active"><i class="fa fa-check"></i></a>
                                            <?php } ?>

                                            <a onclick="return confirm('Are you sure want to delete?');" href="<?= HTTP_ROOT . 'appadmins/other_website_info/delete/' . $data->id; ?>" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>                                            
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script>
    $('#banner_form').validate({
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>

