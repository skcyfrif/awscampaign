<!-- src/Template/AppAdmins/excel_upload.ctp -->
<script src="<?= HTTP_ROOT; ?>js/ck/ckeditor/ckeditor.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>School Excel Upload</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">School Excel Upload</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Excel Upload of School Data</h3>
                    </div>
                    <div class="card-body">
                        <?= $this->Form->create(null, ['type' => 'file']); ?>
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="site_url" class=" form-control-label">Upload Excel File</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="file" id="excel_file" class="form-control" name="file" accept=".xls,.xlsx,.ods" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="<?= HTTP_ROOT; ?>appadmins/excel_upload" class="btn btn-danger">Cancel</a>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Add your custom JavaScript validation or table initialization here if necessary
</script>
