// Set Input Only Numbers
(function($) 
{
    $.fn.inputFilter = function(inputFilter) {
      return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    };
}(jQuery));

$( ".numbers" ).inputFilter(function(value) {
    return /^-?\d*$/.test(value); 
});

// Logic Button Batalkan Pesanan
$( '#batalPesanan' ).click(function(){
    Swal.fire({
        title: '',
        text: "Apakah anda yakin ingin membatalkan pesanan ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?=base_url()?>transaction/transaction/cancel_order?id="+$(this).attr('data-id');
        }
    })
});

// Logic Button Konfirmasi Pesanan Selesai
$( '#pesananSelesai' ).click(function(){
    Swal.fire({
        title: '',
        text: "Apakah anda yakin ingin konfirmasi pesanan selesai?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?=base_url()?>transaction/transaction/complete_order?id="+$(this).attr('data-id');
        }
    })
});