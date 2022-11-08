<div class="card-body overflow-auto p-4">
    <div class="row mb-2">
        <?php foreach ($bank as $r) { 
            $a = "Project : ".$r->nama_proyek." <br/> Item Pekerjaan : ".$r->pekerjaan." <br/> Quality Target : ".$r->kriteria;
            ?>
            <div class="col-md-2 text-center mb-3">
                <div class="setimg">
                    <a href="<?= base_url('uploads/bank_data/'.$r->nama_file);?>" data-lightbox="homePortfolio" title="<?= $a; ?>">
                        <img src="<?= base_url('uploads/bank_data/'.$r->nama_file);?>" />
                    </a>
                    <div id="setimgisi" class="setimgisi">
                        <a href="<?= base_url('uploads/bank_data/'.$r->nama_file);?>" role="button" class="text text-success" download=""><span class="material-icons-round">download</span></a>
                        <a href="#" onclick="return hapus(<?= $r->id ?>);" role="button" class="text text-danger" ><span class="material-icons-round">delete</span></a>
                    </div>
                </div>
            </div>
        <?php }  ?>
    </div>
</div>