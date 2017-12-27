<?php echo $this->output('template/header'); ?>

        <div class="" style="min-height: 550px;">
          <div class="page-title">
          </div>
          <div class="clearfix"></div>
          <?php if($notification){ ?>
		  <div class="alert alert-warning">
		    <strong>Notification:</strong> <?php echo $notification ?>
		  </div>
		  <?php } ?>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-clock-o "></i> Hasil Kualifikasi <small></small></h2>
                  <div align="right">
	                  <button class="btn btn-info" onClick="MyWindow=window.open('<?php echo $this->location('kualifikasi/cetak_hasil_kualifikasi') ?>','Cetak Acakan',width=300,height=300); return false;"><i class="fa fa-print "></i> Cetak Hasil Kualifikasi</button>
	              </div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
	            <div class="table table-responsive">

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Callsign</th>
                        <th>Team</th>
                        <th>Grup</th>
                        <th>Waktu</th>
                      </tr>
                    </thead>
                    <tbody>
	                    <?php 
		                    $no = 1;
		                    foreach($hasil_kualifikasi as $row)
		                    {
			            ?>
			            <tr>
                        <th scope="row"><?php echo $no; ?></th>
                        <td><?php echo $row->nama_pembalap ?></td>
                        <td><?php echo $row->callsign ?></td>
                        <td><?php echo $row->tim ?></td>
                        <td><?php echo $row->grup ?></td>
                        <td><?php echo $this->kualifikasi->cek_waktu($row->waktu) ?></td>
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