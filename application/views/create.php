<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <span>
                            <?=($pk ? 'Edit Kontak' : 'Tambah Kontak');?>
                        </span>
                        <span class="float-right">
                            <a href="<?=base_url('kontak');?>" class="btn btn-primary">Daftar Kontak</a>
                        </span>
                    </h3>
                </div>
                <div class="card-body">
                    <form id="form-kontak">
                        <input type="hidden" id="pk" value="<?=($pk ? $pk : null);?>">
                        <div class="form-group">
                            <h5>Nama Kontak</h5>
                            <input type="text" class="form-control form-control-lg" id="name" placeholder="Asep Yayat" value="<?=($query ? $query->name : null);?>"/>
                        </div>
                        <div class="form-group">
                            <h5>Nomor Telepon</h5>
                            <input type="number" class="form-control form-control-lg" id="number"  placeholder="08xxxxxxxxx" value="<?=($query ? $query->number : null);?>"/>
                        </div>
                        <div class="form-group">
                            <h5>Email</h5>
                            <input type="email" class="form-control form-control-lg" id="email" placeholder="email@domain.com" value="<?=($query ? $query->email : null);?>"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary float-right"><?=($pk ? 'Update' : 'Simpan');?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('form#form-kontak').on('submit', function(e){
        e.preventDefault();
        let pk      = $('#pk').val(),
            name    = $('#name').val(),
            number  = $('#number').val(),
            email   = $('#email').val(),
            url     = '<?=base_url('kontak/save/').$pk;?>',
            loading = $('#blockloading');
        
        loading.removeClass('d-none');
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                pk: pk,
                name: name,
                number: number,
                email: email
            },
            success: function(res){
                loading.addClass('d-none');
                if(res.type == 'saved'){
                    alert('Berhasil membuat data Kontak')
                    location.href = '<?=base_url();?>kontak';
                } else {
                    alert('Berhasil update data Kontak')
                    location.href = '<?=base_url();?>kontak';
                }
            },
            error: function(res){
                loading.addClass('d-none');
            }
        });
    })
});
</script>