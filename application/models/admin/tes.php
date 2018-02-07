<button id="update" class="btn btn-success">update</button>
<div id="demo"></div>
<div id="gagal"></div>
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
    });
</script>