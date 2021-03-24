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

// FITUR OPSI PENILAIAN //

$('small.paket-kosong').hide();
$('small.harga-kosong').hide();
$('small.lama-kosong').hide();
$('small.jumlah-kosong').hide();

function penilaianCheck(){
    let paket = $('select[name=paket_tujuan]');
    let harga = $('select[name=hrg]');
    let jumlah = $('select[name=jml_wisata]');
    let lama = $('select[name=lm_tour]');    
    let status = [false,false,false,false];

    if($(paket).val() == ""){
        status[0] = false;
        $('small.paket-kosong').show();
    } else {
        status[0] = true;
        $('small.paket-kosong').hide();
    }
    if($(harga).val() == ""){
        status[1] = false;
        $('small.harga-kosong').show();
    } else {
        status[1] = true;
        $('small.harga-kosong').hide();
    }
    if($(jumlah).val() == ""){
        status[2] = false;
        $('small.jumlah-kosong').show();
    } else {
        status[2] = true;
        $('small.jumlah-kosong').hide();
    }
    if($(lama).val() == ""){
        status[3] = false;
        $('small.lama-kosong').show();
    } else {
        status[3] = true;
        $('small.lama-kosong').hide();
    }
    
    return status[0] && status[1] && status[2] && status[3];
}

// FITUR CETAK PENILAIAN //

$('[name=cetakPDF]').click(function() {
    $('[name=cetakPDF]').attr('disabled', true);
    $('[name=cetakPDF]').html('<i class="fas fa-print"></i> Sedang Diproses');
    $.ajax({
      method: 'POST',
      url: 'cetakpenilaian.php',
      data: {
        content: document.querySelector('.print').innerHTML
      },
      success: data => {
        $('[name=cetakPDF]').attr('disabled', false);
        $('[name=cetakPDF]').html('<i class="fas fa-print"></i> Export PDF');
        // let btn_cetak = document.createElement('a');
        // let href = document.createAttribute('href');
        // let target = document.createAttribute('target');
        // let id = document.createAttribute('id');
        // href.value = 'cetakpenilaian.php?id_cetak=' + data;
        // target.value = '_blank';
        // id.value = 'btnOpen';
        // btn_cetak.setAttributeNode(href);
        // btn_cetak.setAttributeNode(target);
        // btn_cetak.setAttributeNode(id);
        // document.querySelector('container').appendChild(btn_cetak);
        
        // document.querySelector('#btnOpen').click();
        window.open('cetakpenilaian.php?id_cetak=' + data,'_blank');
    }
    });
  });