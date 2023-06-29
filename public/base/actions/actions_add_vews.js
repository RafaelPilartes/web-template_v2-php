const baseURL = '/base/controllers/'

var url = window.location.pathname
var parts = url.split('/')

var lastPart = parts[parts.length - 1]

const btnPayNow = document.getElementById('btn_pay_now')

btnPayNow.addEventListener('click', async () => {
  await fetch(
    baseURL +
      'productControllers.php?typeForm=new_view_product&idProduct=' +
      lastPart
  ).then(() => {
    console.log('new_view')
  })
})
