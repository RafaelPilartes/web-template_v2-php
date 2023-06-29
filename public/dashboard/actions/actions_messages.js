const baseURL = '/dashboard/controllers/'

const tbody = document.querySelector('tbody')

const msgAlerta = document.getElementById('msgAlertaErroCad')
const cardForm = document.getElementById('registerForm')
const cardEditForm = document.getElementById('editForm')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCard')

const numRegister = document.getElementById('numRegister')
const searchRegister = document.getElementById('searchRegister')
const searchRegisterForm = document.getElementById('searchRegister')
const searchRegisterValue = document.getElementById('searchRegisterValue')

searchRegisterForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(searchRegisterForm)
  dataForm.append('add', 1)

  const dataFetch = await fetch(
    baseURL +
      'messagesControllers.php?typeForm=get_all_message_search&searchRegisterValue=' +
      searchRegisterValue.value
  )

  const response = await dataFetch.json()

  if (response['error']) {
    listMessage(numRegister.value)
    alert(response['msg'])
  } else {
    tbody.innerHTML = response['msg']
    searchRegisterForm.reset()
  }
})

const listMessage = async limitRegister => {
  const data = await fetch(
    baseURL +
      'messagesControllers.php?typeForm=get_all_message&numRegister=' +
      limitRegister
  )
  const response = await data.text()
  tbody.innerHTML = response
}
listMessage(numRegister.value)

numRegister.addEventListener('change', () => {
  listMessage(numRegister.value)
})

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'messagesControllers.php?typeForm=create_message',
    {
      method: 'POST',
      body: dataForm
    }
  )

  const response = await dataNew.json()

  if (response['error']) {
    msgAlerta.innerHTML = response['msg']
  } else {
    msgAlerta.innerHTML = response['msg']
    cardForm.reset()
    listMessage(numRegister.value)
  }

  listMessage(numRegister.value)
  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})

async function confirmDelete(idMessage) {
  await fetch(
    baseURL +
      'messagesControllers.php?typeForm=delete_message&idMessage=' +
      idMessage
  )
  listMessage(numRegister.value)
}

function deleteMessage(idMessage) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar esta mensagem?',
      text: 'Você não será capaz de reverter está acção!',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      showCancelButton: true,
      confirmButtonText: 'Sim, exclua!',
      cancelButtonText: 'Não, cancelar!',
      reverseButtons: true
    })
    .then(result => {
      if (result.isConfirmed) {
        confirmDelete(idMessage)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'Mensagem foi excluído.',
          'success'
        )
        listUsers()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'A mensagem não foi excluído :)',
          'error'
        )
      }
    })
}

async function seeMessage(idMessage) {
  const dataFetch = await fetch(
    baseURL +
      'messagesControllers.php?typeForm=get_message&idMessage=' +
      idMessage
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const messageData = response['dados']
    const cardModal = document.getElementById('modalSee')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    // console.log(response['dados'])
    document.getElementById('id_see').value = messageData.id
    document.getElementById('name_user_see').value = messageData.name_user
    document.getElementById('email_user_see').value = messageData.email_user
    document.getElementById('phone_user_see').value = messageData.phone_user
    document.getElementById('summary_see').value = messageData.summary
    document.getElementById('message_see').value = messageData.message
    document.getElementById('date_create_see').value = messageData.date_create
  }
}
