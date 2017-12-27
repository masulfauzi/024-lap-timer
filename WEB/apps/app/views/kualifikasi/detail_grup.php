<?php echo $this->output('template/header'); ?>

<script type="text/javascript">
/*
    $(document).ready(function(){
      refreshTable();
    });
*/

	var timer_is_on = 0;
	var t;
	
	function startCount() {
	    if (!timer_is_on) {
	        timer_is_on = 1;
	        refreshTable();
	    }
	}
	
	function stopCount() {
	    clearTimeout(t);
	    timer_is_on = 0;
	}
	
	function refreshTable(){
		
		<?php 
			foreach($pembalap as $row3)
			{
		?>
		$('#tableHolder_<?php echo $row3->channel ?>').load('<?php echo $this->location('kualifikasi/get_waktu/'.$row3->channel) ?>', function(){
           //setTimeout(refreshTable, 5000);
        });
		<?php
			}
		?>
/*
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
           //t = setTimeout(refreshTable, 2000);
        });
*/
        
        t = setTimeout(refreshTable, 2000);
        
    }
</script>

<script type="text/javascript">
/*
    $(document).ready(function(){
      refreshsinyal();
    });
*/
	var myVar;
	
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
           
	        myVar = setTimeout(refreshsinyal, 2000);
           
           
        });
    }
    
    
</script>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $(".start_race").on("click",function(){
	        document.getElementById('start_race').disabled = true;
	        
	        document.getElementById("timer").innerHTML = "5";
	        setTimeout(function() {
			    document.getElementById("timer").innerHTML = "4";
			    setTimeout(function() {
				    var audio = new Audio('<?php echo $this->location('../assets/sound/start_race.wav') ?>');
					audio.play();
				    document.getElementById("timer").innerHTML = "3";
				    setTimeout(function() {
					    document.getElementById("timer").innerHTML = "2";
					    setTimeout(function() {
						    document.getElementById("timer").innerHTML = "1";
						    setTimeout(function() {
							    
							    document.getElementById("timer").innerHTML = "GO!!";
							    document.getElementById('stop_race').disabled = false;
							    
// 							    x = 1;
							    setTimeout(function() {
								    $.ajax({
						                url: "<?php echo $this->location('kualifikasi/start_race') ?>",
						                type: "POST",
						                data: { start: 1 }
						            });
								}, 1);
								startCount();
							}, 1000);
						}, 1000);
					}, 1000);
				}, 1000);
			}, 1000);
            
        });
    });
</script>

<script type="text/javascript">
	jQuery(document).ready(function($){
        $(".stop_race").on("click",function(){
	        stopCount();
	        document.getElementById('stop_race').disabled = true;
	        document.getElementById('simpan_hasil').disabled = false;
	        document.getElementById('cetak_hasil').disabled = false;
	        document.getElementById("timer").innerHTML = "STOP";
	    });
    });
</script>

<script type="text/javascript">
	jQuery(document).ready(function($){
        $(".simpan_hasil").on("click",function(){
	        $.ajax({
                url: "<?php echo $this->location('kualifikasi/simpan_hasil_kualifikasi/'.$this->uri->path(2)) ?>",
                type: "POST",
                data: { start: 1 }
            });
            document.getElementById("timer").innerHTML = "Berhasil disimpan";
	    });
    });
</script>

        <div class="" style="min-height: 550px;">
          <div class="page-title">
          </div>
          <div class="clearfix"></div>
          
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
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
            
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-flag-checkered "></i> Detail Kualifikasi <small></small></h2>
                  <div align="right"></div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
		            
		            <button id="start_race" class="btn btn-info start_race"><i class="fa fa-flag-checkered "></i> Start Race</button>
		            <button id="stop_race" disabled="" class="btn btn-danger stop_race"><i class="fa fa-stop "></i> Stop Race</button>
		            <br>
		            <button id="simpan_hasil" disabled="" class="btn btn-default simpan_hasil"><i class="fa fa-save "></i> Simpan Hasil</button>
		            <button onClick="MyWindow=window.open('<?php echo $this->location('kualifikasi/cetak_hasil_kualifikasi_grup/'.$this->uri->path(2)) ?>','Cetak Acakan',width=300,height=300); return false;" id="cetak_hasil" disabled="" class="btn btn-alert cetak_hasil"><i class="fa fa-print "></i> Cetak Hasil</button>
		            
<!-- 		            <div id="timer" style="font-size: 1000;"></div> -->
		            <h1 id="timer"></h1>
	            
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