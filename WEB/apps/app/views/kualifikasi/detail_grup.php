<?php echo $this->output('template/header'); ?>

<script type="text/javascript">
    $(document).ready(function(){
      refreshTable();
    });
	
	function refreshTable(){
        $('#tableHolder_1').load('<?php echo $this->location('kualifikasi/get_waktu/1') ?>', function(){
           //setTimeout(refreshTable, 5000);
        });
        $('#tableHolder_3').load('<?php echo $this->location('kualifikasi/get_waktu/3') ?>', function(){
           //setTimeout(refreshTable, 5000);
        });
        $('#tableHolder_6').load('<?php echo $this->location('kualifikasi/get_waktu/6') ?>', function(){
           //setTimeout(refreshTable, 5000);
        });
        $('#tableHolder_8').load('<?php echo $this->location('kualifikasi/get_waktu/8') ?>', function(){
           
        });
        setTimeout(refreshTable, 2000);
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
      refreshsinyal();
    });
	
	function refreshsinyal(){
        $('#sinyal_1').load('<?php echo $this->location('kualifikasi/get_sinyal/1') ?>', function(){
           //setTimeout(refreshTable, 5000);
        });
        $('#sinyal_3').load('<?php echo $this->location('kualifikasi/get_sinyal/3') ?>', function(){
           //setTimeout(refreshTable, 5000);
        });
        $('#sinyal_6').load('<?php echo $this->location('kualifikasi/get_sinyal/6') ?>', function(){
           //setTimeout(refreshTable, 5000);
        });
        $('#sinyal_8').load('<?php echo $this->location('kualifikasi/get_sinyal/8') ?>', function(){
           setTimeout(refreshsinyal, 2000);
        });
    }
</script>

<!--
<script type="text/javascript">

//Calling function
repeatAjax();


function repeatAjax(){
jQuery.ajax({
          type: "POST",
          url: '<?php echo $this->location('kualifikasi/get_sinyal') ?>',
          dataType: 'json',
          success: function(resp) {
            document.getElementById('sinyal1').style.width = "60%";

          },
          complete: function() {
                setTimeout(repeatAjax,100); //After completion of request, time to redo it after a second
             }
        });
}
</script>
-->
        <div class="" style="min-height: 550px;">
          <div class="page-title">
          </div>
          <div class="clearfix"></div>
          
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-flag-checkered "></i> Detail Grup Kualifikasi <small></small></h2>
                  <div align="right"></div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
	            <div class="table table-responsive">

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Pembalap</th>
                        <th>Callsign</th>
                        <th>Channel</th>
                      </tr>
                    </thead>
                    <tbody>
	                    <?php 
		                    $no = 1;
		                    foreach($pembalap as $row)
		                    {
			            ?>
			            <tr>
				            <td><?php echo $no ?></td>
				            <td><?php echo $row->nama_pembalap ?></td>
				            <td><?php echo $row->callsign ?></td>
				            <td><?php echo $row->channel ?></td>
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
        
        <div class="row">
	        <?php 
		        foreach($pembalap as $row2)
		        {
			?>
			<div class="col-md-3 col-sm-3 col-xs-3">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-user "></i> <?php echo $row2->callsign ?> <small></small></h2>
                  <div align="right"></div>
                  <div class="clearfix"></div>
                </div>
                <div class="progress" id="sinyal_<?php echo $row2->channel ?>">
					
				</div>
                <div class="x_content">
		            <div class="table table-responsive">
	
	                  <div id="tableHolder_<?php echo $row2->channel ?>"></div>
	                  
		            </div>
	            
                </div>
              </div>
            </div>
			<?php
		        }
	        ?>
            
            
          
        </div>
        

<?php echo $this->output('template/footer'); ?>        