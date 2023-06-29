const baseURL = '/dashboard/controllers/'

const cardForm = document.getElementById('loginForm')
const msgAlerta = document.getElementById('msgAlertaErroCad')

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNewUser = await fetch(
    baseURL + 'admControllers.php?type_form=login_adm',
    {
      method: 'POST',
      body: dataForm
    }
  )

  const response = await dataNewUser.json()

  if (response['error']) {
    msgAlerta.innerHTML = response['msg']
  } else {
    msgAlerta.innerHTML = response['msg']
    localStorage.setItem('adm_deal_days_name', response['adm_name'])
    localStorage.setItem('adm_deal_days_email', response['adm_email'])
    window.location.reload()
  }

  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})
