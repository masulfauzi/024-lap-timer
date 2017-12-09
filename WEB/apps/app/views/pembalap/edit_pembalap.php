<?php echo $this->output('template/header'); ?>	  	
        
        <div class="" style="min-height: 550px;">
          <div class="page-title">
            

            
          </div>
          <div class="clearfix"></div>
          
          
          
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-edit "></i> Edit Pembalap <small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br>
                  <form enctype="multipart/form-data" action="<?php echo $this->location('pembalap/aksi_edit_pembalap') ?>" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">
                    <input type="hidden" name="id_pembalap" value="<?php echo $pembalap->id_pembalap ?>" >
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Pembalap <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="nama_pembalap" required="" value="<?php echo $pembalap->nama_pembalap ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Callsign <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="callsign" required="" value="<?php echo $pembalap->callsign ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TIM <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="tim" required="" value="<?php echo $pembalap->tim ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kota <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="kota" required="" value="<?php echo $pembalap->kota ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto Sekarang <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <img width="200" src="<?php echo $this->location('../assets/pembalap/'.$pembalap->foto) ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ganti Foto Pembalap <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" class="form-control" name="foto">
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