<?php echo $this->output('template/header'); ?>	  	
        
        <div class="" style="min-height: 550px;">
          <div class="page-title">
            

            
          </div>
          <div class="clearfix"></div>
          
          
          
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Tambah User <small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br>
                  <form action="<?php echo $this->location('manajemen/aksi_tambah_user') ?>" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username Sikadu <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="username">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Lengkap <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="nama_lengkap">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="email">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">NIP/NRP <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="kode_identitas">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
	                      <select class="form-control" name="id_unit_kerja">
		                      <option value="0"> - PILIH SALAH SATU - </option>
                        <?php 
	                        foreach($unit_kerja as $row)
	                        {
		                ?>
		                <option value="<?php echo $row->id_unit_kerja ?>"><?php echo $row->unit_kerja ?></option>
		                <?php
	                        }
                        ?>
	                      </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jabatan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="id_privileges">
		                      <option></option>
                        <?php 
	                        foreach($privileges as $row_privileges)
	                        {
		                ?>
		                <option value="<?php echo $row_privileges->id_privileges ?>"><?php echo $row_privileges->privileges ?></option>
		                <?php
	                        }
                        ?>
	                      </select>
                      </div>
                    </div>
                                        
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
          
          

          
          
          
          
          
        </div>
        

<?php echo $this->output('template/footer'); ?>        