<script src="<?= HTTP_ROOT; ?>js/ck/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
      /* .all-inq-body .inq-form-body {
         margin: 30px auto 50px auto;
         padding: 30px;
         max-width: 750px;
         background: #fff;
         border-radius: 10px;
         box-shadow: 0 0 5px rgb(0 0 0 / 18%);
      } */
      .details .details-group {
        padding: 20px;
      }
      .form-box{
    padding: 10px;
    }
     
      
      /* label{
      width: 100%;
      float: left;
      color: #000;
      font-size: 20px;
      margin-bottom: 10px;
    } */
    /* .form-box input[type="text"]{
      width:100%;
      float:left;
    }
    .form-box input[type="submit"]{

      float: left;
      padding: 5px 15px;
      margin: 10px 10px;
      color: white;
      background: black;
      border: none;
      cursor: pointer;

    } */
    /* <div class="card card-primary">
    <section class="all-inq-body">
      <div class="inq-form-body"> */
      
      </style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Category </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">
                   
                    <!-- /.card-header -->
                    <div class="card-body">
                   
      <?= $this->Form->create('categories', [ "name"=>"catform", "id" => "categories",'method' => 'post']); ?> 
                          <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="site_url" class=" form-control-label">Category Name :</label>
                            </div>
                            <div class="col-6 col-md-9">
                                <input type="text" id="site_url"  class="form-control" name="cat_name" required value="<?php
                                if (!empty($getData)) {
                                    echo $getData->cat_name;
                                }
                                ?>">
                            </div>
                        </div>
         <?php if(!empty($getData->id)){?>
        <button type="submit" class="btn btn-success" name="submit" >Update</button>
        <?php }else { ?>
          <button type="submit" class="btn btn-success" name="submit" >Submit</button>
          <?php } ?>
                <?= $this->Form->end(); ?>
                  </div>
                </div>
            </div>
        </div>
    </section>
</div>
