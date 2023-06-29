const base_URL = '/base/controllers/'
const origin_url = window.location.origin

const btnExit = document.getElementById('btn_exit')

async function exitLogin() {
  await fetch(base_URL + 'customerControllers.php?typeForm=logout_customer')

  location.reload()
}
