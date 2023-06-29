const baseURL = '/base/controllers/'
const origin_url = window.location.origin

const cardForm = document.getElementById('registerForm')
const msgAlerta = document.getElementById('msgAlertaErroCad')

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNewUser = await fetch(
    baseURL + 'customerControllers.php?typeForm=create_customer',
    {
      method: 'POST',
      body: dataForm
    }
  )

  const response = await dataNewUser.json()

  if (response['error']) {
    console.log(msgAlerta)
    msgAlerta.innerHTML = response['msg']
  } else {
    msgAlerta.innerHTML = response['msg']

    window.location.replace(origin_url + '/login')
  }

  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 3000)
})
