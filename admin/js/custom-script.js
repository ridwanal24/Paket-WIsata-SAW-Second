// FITUR TAMBAH PAKET WISATA//
$(document).ready(function(){
    if($('select[name=pilihan-paket]').val() == 'paket-baru'){
        $('.nama-11').hide();
        $('.nama-22').show();
    } else if ($('select[name=pilihan-paket]').val() == 'pilihan-baru'){
        $('.nama-11').show();
        $('.nama-22').hide();
    }
});

$('select[name=pilihan-paket]').change(function(){
    if($(this).val() == 'paket-baru'){
        $('.nama-11').hide();
        $('.nama-22').show();
    } else if ($(this).val() == 'pilihan-baru'){
        $('.nama-11').show();
        $('.nama-22').hide();
    }
});