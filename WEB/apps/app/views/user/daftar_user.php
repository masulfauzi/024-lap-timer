<?php echo $this->output('template/header'); ?>



	  	
        
        <div class="" style="min-height: 550px;">
          <div class="page-title">
            

            
          </div>
          <div class="clearfix"></div>
          
          
          
          <div class="row">
                    
          

          
          
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Rekap User <small></small></h2>
                  <div align="right"><button class="btn btn-info" onclick="location.href='<?php echo $this->location('manajemen/tambah_user') ?>';">Tambah User</button></div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
	            <div class="table table-responsive">

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Unit Kerja</th>
                        <th>Jabatan di Sistem</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
	                    <?php 
		                    $no = 1;
		                    foreach($user as $row)
		                    {
			            ?>
			            <tr>
                        <th scope="row"><?php echo $no; ?></th>
                        <td><?php echo $row->nama_lengkap ?></td>
                        <td><?php echo $row->unit_kerja ?></td>
                        <td><?php echo $row->privileges ?></td>
                        <td></td>
                      </tr>
			            <?php
				            $no ++;
		                    }
	                    ?>
			          
			            
                      
                    </tbody>
                  </table>
	            </div>

                </div>
              </div>
            </div>

            
          </div>
          
          
        </div>
        

<?php echo $this->output('template/footer'); ?>        