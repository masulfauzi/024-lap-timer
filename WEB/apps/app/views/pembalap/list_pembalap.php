<?php echo $this->output('template/header'); ?>
<script>
	$(document).on("click", ".bahaya", function(e) {
        var link = $(this).attr("href"); // "get" the intended link in a var
        e.preventDefault();    
        bootbox.confirm("Anda yakin akan menghapus Pembalap ini?", function(result) {    
            if (result) {
                document.location.href = link;  // if result, "set" the document location       
            }    
        });
    });
	
</script>
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
                  <h2><i class="fa fa-user "></i> List Pembalap <small></small></h2>
                  <div align="right"><button class="btn btn-info" onclick="location.href='<?php echo $this->location('pembalap/tambah_pembalap') ?>';"><i class="fa fa-user-plus "></i> Tambah Pembalap</button></div>
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
                        <th>Foto</th>
                        <th>Team</th>
                        <th>Kota</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
	                    <?php 
		                    $no = $pagination['mulai'] + 1;
		                    foreach($pembalap as $row)
		                    {
			            ?>
			            <tr>
                        <th scope="row"><?php echo $no; ?></th>
                        <td><?php echo $row->nama_pembalap ?></td>
                        <td><?php echo $row->callsign ?></td>
                        <td><img width="200" src="<?php echo $this->location('../assets/pembalap/'.$row->foto) ?>"></td>
                        <td><?php echo $row->tim ?></td>
                        <td><?php echo $row->kota ?></td>
                        <td><button onclick="window.location.href='<?php echo $this->location('pembalap/edit_pembalap/'.$row->id_pembalap) ?>'" class="btn btn-info"><i class="fa fa-edit "></i> Edit</button> <a class="btn btn-danger bahaya" href="<?php echo $this->location('pembalap/hapus_pembalap/'.$row->id_pembalap) ?>" data-toggle="modal" data-target="#confirm-delete">Hapus</a></td>
                      </tr>
			            <?php
				            $no ++;
		                    }
	                    ?>
                    </tbody>
                  </table>
	            </div>
	            <?php if($pagination['total_halaman'] > 1){ ?>
	            <div class="page-nation" align="center">
                    <ul class="pagination pagination-large">
	                    <?php
		                    for($i=1; $i<=$total_page; $i++)
		                    {
			            ?>
			            <li><a href="<?php echo $this->location('pembalap/list_pembalap/'.$i) ?>"><?php echo $i ?></a></li>
			            <?php
		                    }
						?>
                 	</ul>
        		</div>
        		<?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        

<?php echo $this->output('template/footer'); ?>        