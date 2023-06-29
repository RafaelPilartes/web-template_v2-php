const baseURL = '/base/controllers/'
const origin_url = window.location.origin

const cardForm = document.getElementById('messageForm')
const msgAlerta = document.getElementById('msgAlertaErroCad')

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataFetch = await fetch(
    baseURL + 'messageControllers.php?typeForm=send_message',
    {
      method: 'POST',
      body: dataForm
    }
  )

  const response = await dataFetch.json()

  if (response['error']) {
    console.log(msgAlerta)
    msgAlerta.innerHTML = response['msg']
  } else {
    msgAlerta.innerHTML = response['msg']
  }

  cardForm.reset()
  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})
