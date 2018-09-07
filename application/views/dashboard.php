<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <span>
                            Daftar Kontak
                        </span>
                        <span class="float-right">
                            <a href="<?=base_url('kontak/create');?>" class="btn btn-primary">+ Kontak</a>
                        </span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>No. Telpon</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($kontak) > 0):?>
                                <?php foreach($kontak as $k):?>
                                <tr>
                                    <td><?=$k->name;?></td>
                                    <td><?=$k->number;?></td>
                                    <td><?=$k->email;?></td>
                                    <td width="15%">
                                        <span>
                                            <a href="<?=base_url('kontak/create/').$k->id;?>">Edit</a>
                                        </span>
                                        <span>
                                            <a href="javascript:void(0)" onclick="on_delete(<?=$k->id;?>)">Hapus</a>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan=4>
                                        <p class="alert alert-danger">Tidak ada kontak ditemukan, silahkan <a href="<?=base_url('kontak/create');?>">tambah kontak</a>.</p>
                                    </td>
                                </tr>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function on_delete(pk){
        let loading = $('#blockloading');
        if(confirm('Apakah anda yakin menghapus kontak ini?')){
            /**
            * Jika dikonfirmasi jalankan perintah ajax
            **/
            loading.removeClass('d-none');
            $.ajax({
                url: '<?=base_url('kontak/delete');?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    pk: pk
                },
                success: function(res){
                    loading.addClass('d-none');
                    if(res.type == 'deleted'){
                        alert('Berhasil Menghapus Data')
                        window.location.reload()
                    } else {
                        alert('Data tidak terhapus, ulangi.')
                        window.location.reload()
                    }
                },
                error: function(res){
                    loading.addClass('d-none');
                }
            });
        } else {
            alert('Tindakan dibatalkan')
        }
    }
</script>