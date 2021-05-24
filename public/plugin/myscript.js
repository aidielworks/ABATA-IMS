const flashData = $('.flashData').data('flashdata-type');
const flashDataWrong = $('.flashDataWrong').data('flashdata-type');
const flashDataLogin = $('.flashDataLogin').data('flashdata-type');

if (flashData) {

  Swal.fire({
    icon: 'success',
    title: flashData,
    showConfirmButton: false,
    timer: 1500
  })

}

if (flashDataWrong) {

  Swal.fire({
    icon: 'error',
    title: flashDataWrong,
    showConfirmButton: false,
    timer: 1500
  })

}

if (flashDataLogin) {

  Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: flashDataLogin,
    showConfirmButton: false,
    timer: 900
  })

}


$('.delete-button').on('click', function (e) {
  e.preventDefault();

  Swal.fire({
    title: 'Are you sure want to delete?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $("#form").submit();
    }
  })
});