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
                  <h2><i class="fa fa-users "></i> List Grup Kualifikasi <small></small></h2>
                  <div align="right"></div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
	            <div class="table table-responsive">

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Grup</th>
                        <th>Pembalap</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
	                    <?php 
		                    $no = 1;
		                    foreach($grup as $row)
		                    {
			            ?>
			            <tr>
                        <th scope="row"><?php echo $no; ?></th>
                        <td><?php echo $row->grup ?></td>
                        <td>
	                        <ul>
	                        <?php
		                        foreach($this->kualifikasi->get_pembalap_by_grup($row->grup) as $row2)
		                        {
			                ?>
			                <li><strong><?php echo $row2->nama_pembalap ?></strong> Channel <?php echo $row2->channel ?></li>
			                <?php
		                        }
		                    ?>
	                        </ul>
                        </td>
                        <td><button onclick="window.location.href='<?php echo $this->location('kualifikasi/detail_grup_kualifikasi/'.$row->grup) ?>'" class="btn btn-info"><i class="fa fa-flag-checkered "></i> Detail</button></td>
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