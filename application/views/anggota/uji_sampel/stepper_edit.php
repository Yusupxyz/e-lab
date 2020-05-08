<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Multi Step Bootstrap Form with animations</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">

<link rel="stylesheet" href="<?php echo base_url().'assets/stepper/style.css'?>">
</head>
<body>
<!-- partial:index.partial.html -->

<!--PEN CONTENT     -->
<div class="content">
  <!--content inner-->
  <div class="content__inner">
    <div class="container">
      <!--animations form-->
      <form class="pick-animation my-4">
        <div class="form-row">
          <div class="col-5 m-auto">
            <select class="pick-animation__select form-control" hidden>
              <option value="scaleIn" selected="selected">ScaleIn</option>
              <option value="scaleOut">ScaleOut</option>
              <option value="slideHorz">SlideHorz</option>
              <option value="slideVert">SlideVert</option>
              <option value="fadeIn">FadeIn</option>
            </select>
          </div>
        </div>
      </form>
    </div>
    <div class="container overflow-hidden">
      <!--multisteps-form-->
      <div class="multisteps-form">
        <!--progress bar-->
        <div class="row">
          <div class="col-12 col-lg-12 ml-auto mr-auto mb-4">
            <div class="multisteps-form__progress">
              <button class="multisteps-form__progress-btn js-active" type="button" title="Pengambilan">Pengambilan</button>
              <button class="multisteps-form__progress-btn" type="button" title="Data Sampel">Data Sampel</button>
              <button class="multisteps-form__progress-btn" type="button" title="Parameter">Parameter</button>
              <button class="multisteps-form__progress-btn" type="button" title="Catatan dan Kirim">Kirim</button>
            </div>
          </div>
        </div>
        <!--form panels-->
        <div class="row">
          <div class="col-12 col-lg-12 m-auto">
            <form  action="<?php echo base_url().'anggota/uji_sampel/update'?>" method="post" enctype="multipart/form-data" class="multisteps-form__form">
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Pengambilan sampel dilakukan oleh :</h3>
                <div class="multisteps-form__content">
                  <div class="form-row mt-4">
                    <div class="col-12 col-sm-12">
                    <select class="form-control" name="pengambilan" id="pengambilan" required>
                      <option value=''>--Pilih--</option>
                      <option <?= ($pengambilan=="Pelanggan")? "selected" : ""; ?>>Pelanggan</option>
                      <option <?= ($pengambilan=="Laboratorium")? "selected" : ""; ?>>Laboratorium</option>
                    </select>
                    </div>
                  </div>
                  
                  <div class="button-row d-flex mt-4">
                    <button id="button1" class="btn btn-primary ml-auto js-btn-next" type="button" title="Next" >Next</button>
                  </div>
                </div>
              </div>
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Lengkapi Data Sampel :</h3>
                <div class="multisteps-form__content">
                  <div class="form-row mt-4">
                    <div class="col">
                      <input class="multisteps-form__input form-control" type="hidden" name="xpdf"  value="<?= $file ?>"/>
                      <input class="multisteps-form__input form-control" type="text" name="xkode" id="xkode" placeholder="Kode/Nama Sampel Pelanggan" value="<?= $kode_sampel ?>"/>
                    </div>
                  </div>
                  <div class="form-row mt-4">
                    <div class="col">
                      <?php
                          echo form_dropdown('xjenis_sampel', $jenis_sampel, $xjenis_sampel, $attribute);
                      ?>
                    </div>
                  </div>
                  <div class="form-row mt-4">
                    <div class="col">
                      <?php
                        echo form_dropdown('xjenis_wadah', $jenis_wadah, $xjenis_wadah, $attribute2);
                      ?>
                    </div>
                  </div>
                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                    <button id="button2" class="btn btn-primary ml-auto js-btn-next" type="button" title="Next" >Next</button>
                  </div>
                </div>
              </div>
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Parameter yang di uji :</h3>
                <div class="multisteps-form__content">
                  <div class="accordion" id="accordionExample">
                    <?php foreach ($sifat_pengujian as $key => $value) { ?>
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $value->sp_id ?>" aria-expanded="true" aria-controls="collapseOne">
                             <h4> <?= $value->sp_jenis ?> </h4>
                            </button>
                          </h2>
                        </div>

                        <div id="collapse<?= $value->sp_id ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body" style="padding-left:20px;">
                            <div class="form-check form-check-inline" >
                            <?php  foreach ($parameter[$value->sp_id] as $key => $value2) { 
                                 $exist=array_search($value2->pu_id, $parameter_us);
                              ?>
                              <input disabled class="form-check-input" onchange='handleChange(this);' name="xparam<?= $value->sp_id ?>[]" id="xparam<?= $value->sp_id ?>[]" type="checkbox" id="inlineCheckbox1" value="<?= $value2->pu_id ?>" data-value="<?= $value2->pu_nama ?>" <?= (is_numeric($exist))?'checked':''?>>
                              <label class="form-check-label" for="inlineCheckbox1"><?= $value2->pu_nama ?></label>&nbsp;
                            <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  <div class="row">
                    <div class="button-row d-flex mt-4 col-12">
                      <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                      <button id="button3" class="btn btn-primary ml-auto js-btn-next" type="button" title="Next" >Next</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
              <h3 class="multisteps-form__title">Surat Permohonan (format file pdf)</h3>
                <div class="multisteps-form__content">
                <div class="form-row mt-4">
                    <input type="file" id="xfile" name="xfile" class="multisteps-form__textarea form-control" accept="application/pdf"/>
                  </div>
                  <h3 class="multisteps-form__title">Catatan Tambahan (jika perlu)</h3>
                  <div class="form-row mt-4">
                    <textarea name="xcatatan" class="multisteps-form__textarea form-control" placeholder="Catatan Tambahah Jika Diperlukan"></textarea>
                  </div>
                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                    <button id="button4" class="btn btn-success ml-auto" data-toggle="modal" data-target="#exampleModal" id="a" type="button" title="Send">Kirim</button>
                  </div>
                </div>
              </div>
              <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Konfirmasi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Apa anda yakin mengubah data uji sampel anda?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="xid" value="<?= $us_id ?>" class="btn btn-success">Ubah</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                  </div>
                </div>
              </div>
              </div>    
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- partial -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'></script>
  <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>

<script  src="<?php echo base_url().'assets/stepper/script.js'?>"></script>
<script>
  var count=0;
$(document).ready(function() {
  $("#pengambilan").change(function() {
      value = $(this).val();
      if (value!=''){
        $(':input[id="button1"]').prop('disabled', false);
      }else{
        $(':input[id="button1"]').prop('disabled', true);
      }
    });

    $('#xkode').change(function(){
      value = $(this).val();
      value2 = $('select[name=xjenis_sampel] option').filter(':selected').val();
      value3 = $('select[name=xjenis_wadah] option').filter(':selected').val();
      if (value!='' && value2 !='' && value3 !=''){
        $(':input[id="button2"]').prop('disabled', false);
      }else{
        $(':input[id="button2"]').prop('disabled', true);
      }
    });

    $("#xjenis_sampel").change(function() {
      value = $(this).val();
      value2 = document.getElementById('xkode').value;
      value3 = $('select[name=xjenis_wadah] option').filter(':selected').val();
      if (value!='' && value2 !='' && value3 !=''){
        $(':input[id="button2"]').prop('disabled', false);
      }else{
        $(':input[id="button2"]').prop('disabled', true);
      }
    });

    $("#xjenis_wadah").change(function() {
      value = $(this).val();
      value2 = document.getElementById('xkode').value;
      value3 = $('select[name=xjenis_sampel] option').filter(':selected').val();
      if (value!='' && value2 !='' && value3 !=''){
        $(':input[id="button2"]').prop('disabled', false);
      }else{
        $(':input[id="button2"]').prop('disabled', true);
      }
    });

    $("#xfile").change(function() {
    if(this.files[0].size > 5000000){
       alert("Ukuran file maksimal 5MB");
       this.value = "";
      }
  });
  } );

  function handleChange(checkbox) {
    if(checkbox.checked == true){
      count++;
    }else{
      count--;
   }
   console.log(count);
   if (count>0){
      $(':input[id="button3"]').prop('disabled', false);
  }else{
      $(':input[id="button3"]').prop('disabled', true);
   }
}
</script>
</body>
</html>