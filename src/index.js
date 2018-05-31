$(document).ready(() => {
  //$('.loading').fadeOut()
  //$('.table').fadeIn()
})
function locate() {
  if(!navigator.geolocation) {
    $('.alerts').html("<div class='alert alert-danger'>Locating your position is not possible due to your browser.</div>")
    return
  }
  function success(pos) {
    $('.alerts').html(`<div class='alert alert-success'>Your position: ${pos.coords.latitude}&nbsp;${pos.coords.longitude}</div>`)
    $('#pos-field').val(`pos_lon=${pos.coords.longitude}&pos_lat=${pos.coords.latitude}`)
  }
  function error() {
    $('.alerts').html("<div class='alert alert-danger'>Locating your position is not possible.</div>")
  }
  navigator.geolocation.getCurrentPosition(success, error)
}