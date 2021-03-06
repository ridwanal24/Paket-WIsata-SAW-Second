// ========== VALIDASI FORM LOGIN ========== //

// -- Inisialisasi alert -- //
let emailExist = false;
let usernameExist = false;
let status = true;
resetAlert();

let nama;
let alamat;
let telepon;
let email;
let username;
let password;
let captcha;

// Show Password Handle
$('input[name=show_password]').change(function(){
    if(this.checked){
        $('input[name=password]').attr('type','text');
    } else {
        $('input[name=password]').attr('type','password');
    }
});

// -- Check Email and Username if Exist
// Email
$('input[name=email]').on('keyup change',function(){
    $.ajax({
        method:"POST",
        url:"buatakun_cek.php",
        data: {
            cek_email: "yes",
            email: $('input[name=email]').val()
        },
        success: data => {
            if(parseInt(data) >= 1){
                emailExist = true;
            } else {
                emailExist = false;
            }
            console.log(emailExist);
        }
    });
});

// Username
$('input[name=username]').on('keyup change',function(){
    $.ajax({
        method:"POST",
        url:"buatakun_cek.php",
        data: {
            cek_username: "yes",
            username: $('input[name=username]').val()
        },
        success: data => {
            if(parseInt(data) >= 1){
                usernameExist = true;
            } else {
                usernameExist = false;
            }
            console.log(usernameExist);
            resetAlert();
        }
    });
});

// ===== AFTER PRESSED ===== //

// let nama = document.forms['validasi_register']['nama'].value;
// let alamat = document.forms['validasi_register']['alamat'].value;
// let telepon = document.forms['validasi_register']['telepon'].value;
// let email = document.forms['validasi_register']['email'].value;
// let username = document.forms['validasi_register']['username'].value;
// let password = document.forms['validasi_register']['password'].value;
// let captcha = document.forms['validasi_register']['kodecaptcha'].value;

$('[name=nama]').on('keyup change', function(){
    nama = $(this).val();
    if(nama == ''){
        $('.nama-kosong-alert').show();
        $('input[name=nama]').focus();
        status = false;
    } else {
        if(!nama.match(/^[a-zA-Z\s]+$/)){
            $('.nama-karakter-alert').show();
            $('input[name=nama]').focus();
            status= false;
        } else {
            resetAlert();
            status = true;
        }
    }
});

$('[name=alamat]').on('keyup change',function(){
    alamat = $(this).val();
    if(alamat == ''){
        $('.alamat-kosong-alert').show();
        $('input[name=alamat]').focus();
        status = false;
    } else {
        resetAlert();
        status = true;
    }
});

$('[name=telepon]').on('keyup change',function(){
    telepon = $(this).val();
    
    if(telepon == ''){
        $('.telepon-kosong-alert').show();
        $('input[name=telepon]').focus();
        status = false;
    } else {
        if(!telepon.match(/^[0-9]+$/)){
            $('.telepon-karakter-alert').show();
            $('input[name=telepon]').focus();
            status = false;
        } else {
            resetAlert();
            status = true;
        }
    }
});

$('[name=email]').on('keyup change', function(){
    email = $(this).val();
    if(email == ''){
        $('.email-kosong-alert').show();
        $('input[name=email]').focus();
        status = false;
    } else {
        if(!email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)){
            $('.email-karakter-alert').show();
            $('input[name=email]').focus();
            status = false;
        } else {
            if(emailExist){
                $('.email-exist-alert').show();
                $('input[name=email]').focus();
                status = false;
            }  else {
                resetAlert();
                status = true;
            }
        }
    }
});

$('[name=username]').on('keyup change', function(){
    username = $(this).val();
    if(username == ''){
        $('.username-kosong-alert').show();
        $('input[name=username]').focus();
        status = false;
    } else {
        if(usernameExist){
            $('.username-exist-alert').show();
            $('input[name=username]').focus();
            status = false;
        }  else {
            resetAlert();
            status = true;
        }
    }
});

$('[name=password]').on('keyup change', function(){
    password = $(this).val();
    if(password == ''){
        $('.password-kosong-alert').show();
        $('input[name=password]').focus();
        status = false;
    } else {
        resetAlert();
        status = true;
    }
});

$('[name=kodecaptcha').on('keyup change', function(){
    if(captcha == ''){
        $('.kodecaptcha-kosong-alert').show();
        $('input[name=kodecaptcha]').focus();
        status = false;
    } else {
        resetAlert();
        status = true;
    }
});
// Cek Nama Lengkap

// Cek Alamat

// Cek Nomor Telepon

// Cek Email

// Cek Username

// Cek Password

// Cek Captcha

// ===== END OF AFTER PRESSED ===== //




// Fungsi validasi form
function validasiRegister(){
    $('.kodecaptcha-salah-alert').hide();
    resetAlert();
    return status;
}

// Fungsi reset alert
function resetAlert(){
    $('.nama-kosong-alert').hide();
    $('.nama-karakter-alert').hide();
    $('.alamat-kosong-alert').hide();
    $('.telepon-kosong-alert').hide();
    $('.telepon-karakter-alert').hide();
    $('.email-kosong-alert').hide();
    $('.email-karakter-alert').hide();
    $('.email-exist-alert').hide();
    $('.username-kosong-alert').hide();
    $('.username-exist-alert').hide();
    $('.password-kosong-alert').hide();
    $('.kodecaptcha-kosong-alert').hide();
    // $('.kodecaptcha-salah-alert').hide();
}