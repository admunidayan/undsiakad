<?php 
$hostname = $this->ion_auth->user()->row()->hostname;
$port = $this->ion_auth->user()->row()->port;
$url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
$client = new nusoap_client($url, true);
$proxy = $client->getProxy();
$username =$this->ion_auth->user()->row()->userfeeder;
$pass = $this->ion_auth->user()->row()->passfeeder;
$token = $proxy->getToken($username, $pass);
$table = 'mahasiswa_pt';
$filter ='';
$jml = $proxy->GetCountRecordset($token,$table,$filter);
$getjumlah =$jml['result'];
// mhs keluar
$order ='';
$limit =10;
$offest =0;
$filter2 ="p.id_jns_keluar ='1'";
// kml mhs keluar
$jmlmhs = $proxy->GetCountRecordset($token,$table,$filter2);
$getjumlahmhs =$jmlmhs['result'];
 ?>
<div id="jumlah"><?php echo $getjumlah; ?></div>
<button id="importdata" class="btn btn-success">update</button>
<div id="ktkimportdata"></div>
<div id="demo"></div>
<div id="gagal"></div>
<!--  -->
<div class="panel panel-default">
    <div class="panel-heading">Mahasiswa lulus</div>
    <div class="panel-body">
     <button id="mhslulus" class="btn btn-success">import</button>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Daftar mahasiswa keluar</div>
    <div class="panel-body">
        <div id="jmlout"><?php echo $getjumlahmhs; ?></div>
     <?php 
        $result = $proxy->getRecordset($token,$table,$filter2,$order,$limit,$offest);
        echo "<pre>";print_r($result);echo "</pre>";
      ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Pembimbing</div>
    <div class="panel-body">
     <?php 
        $result2 = $proxy->getRecordset($token,'dosen_pembimbing',$filter,$order,$limit,$offest);
        echo "<pre>";print_r($result2);echo "</pre>";
      ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#importdata").click(function(){

            var jml = $('#jumlah').html();
            var dtfinish =0;
            var dtvail =0;
            // default loop
            
            var loop = Math.ceil(jml/100);
            $('#ktkimportdata').remove();
            // asd
            for (var i = 0; i <= loop; i++) {
                // $('#demo').append(i+' dan '+i*100+loop+"<br/>");
                document.getElementById("demo").innerHTML = "<div class='tengah bts-ats2'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+loop+" berhasil di import ...</div>";
                $.ajax({
                    url : "<?php echo base_url('index.php/admin/setting/proses_update/'); ?>"+i*100,
                    type:'get',
                    success:function(data){
                        $('#hitung').html(dtfinish++);
                    },
                    error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
                        document.getElementById("gagal").innerHTML = "<i class='fa fa-warninng txtpink'></i> "+dtvail+++" data gagal";
                    }
                })
            }
        });
        $("#mhslulus").click(function(){

            var jml = $('#jmlout').html();
            var dtfinish =0;
            var dtvail =0;
            // default loop
            
            var loop = Math.ceil(jml/100);
            $('#ktkimportdata').remove();
            // asd
            for (var i = 0; i <= loop; i++) {
                // $('#demo').append(i+' dan '+i*100+loop+"<br/>");
                document.getElementById("demo").innerHTML = "<div class='tengah bts-ats2'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+loop+" berhasil di import ...</div>";
                $.ajax({
                    url : "<?php echo base_url('index.php/admin/setting/proses_import_mhs_lulus/'); ?>"+i*100,
                    type:'get',
                    success:function(data){
                        $('#hitung').html(dtfinish++);
                    },
                    error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
                        document.getElementById("gagal").innerHTML = "<i class='fa fa-warninng txtpink'></i> "+dtvail+++" data gagal";
                    }
                })
            }
        });
    });
</script>