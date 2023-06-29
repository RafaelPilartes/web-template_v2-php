const baseURL = '/dashboard/controllers/'

const tbody = document.querySelector('tbody')
const cardForm = document.getElementById('registerForm')
const cardEditForm = document.getElementById('editForm')
const msgAlerta = document.getElementById('msgAlertaErroCad')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCad')

const btnExit = document.getElementById('btn_exit')

const inputImagens = document.getElementById('inputImagens')
const containerImagens = document.getElementById('containerImagens')
const inputImagensEdit = document.getElementById('inputImagensEdit')
const containerImagensEdit = document.getElementById('containerImagensEdit')

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
      'admUserControllers.php?typeForm=get_all_adm_search&searchRegisterValue=' +
      searchRegisterValue.value
  )

  const response = await dataFetch.json()

  if (response['error']) {
    listAdm(numRegister.value)
    alert(response['msg'])
  } else {
    tbody.innerHTML = response['msg']
    cardForm.reset()
  }
})

numRegister.addEventListener('change', () => {
  listAdm(numRegister.value)
})

inputImagens.addEventListener('change', function () {
  containerImagens.innerHTML = ''
  const files = this.files

  console.log(files[0])

  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    const reader = new FileReader()

    reader.addEventListener('load', function () {
      const imagem = document.createElement('img')
      imagem.src = reader.result
      containerImagens.appendChild(imagem)
    })

    reader.readAsDataURL(file)
  }
})
inputImagensEdit.addEventListener('change', function () {
  containerImagensEdit.innerHTML = ''
  const files = this.files

  console.log(files[0])

  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    const reader = new FileReader()

    reader.addEventListener('load', function () {
      const imagem = document.createElement('img')
      imagem.src = reader.result
      containerImagensEdit.appendChild(imagem)
    })

    reader.readAsDataURL(file)
  }
})

const listAdm = async limitRegister => {
  const dataUsers = await fetch(
    baseURL +
      'admUserControllers.php?typeForm=get_adms&numRegister=' +
      limitRegister
  )

  const response = await dataUsers.text()

  tbody.innerHTML = response
}

listAdm(numRegister.value)

cardForm.addEventListener('submit', async event => {
  event.preventDefault()
  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNewUser = await fetch(
    baseURL + 'admUserControllers.php?typeForm=create_adm',
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
    cardForm.reset()
    listAdm(numRegister.value)
  }

  listAdm(numRegister.value)
  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})

async function confirmDelete(idAdm) {
  await fetch(
    baseURL + 'admUserControllers.php?typeForm=delete_adms&idAdm=' + idAdm
  )
  listAdm(numRegister.value)
}

function deleteAdm(idAdm) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar este adm?',
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
        confirmDelete(idAdm)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'Adm foi excluído.',
          'success'
        )
        listAdm(numRegister.value)
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'O adm não foi excluído :)',
          'error'
        )
      }
    })
}

async function editeAdm(idAdm) {
  const dataUsers = await fetch(
    baseURL + 'admUserControllers.php?typeForm=get_adm&idAdm=' + idAdm
  )

  const response = await dataUsers.json()
  if (response['error']) {
    alert(response['msg'])
  } else {
    const admData = response['dados']
    const cadModal = document.getElementById('modalEdite')

    cadModal.style.visibility = 'visible'
    cadModal.classList.add('show')

    // console.log(response['dados'])

    // let namePermission = ''
    // if (AdmData.permissions_adm == 'read') {
    //   namePermission = 'Apenas leitura'
    // } else if (AdmData.permissions_adm == 'write') {
    //   namePermission = 'Apenas cadastrar'
    // } else if (AdmData.permissions_adm == 'all_permissions') {
    //   namePermission = 'Todas as permissões'
    // }

    const image_adm_array = JSON.parse(admData.image_adm)

    document.getElementById('id_edit').value = admData.id
    document.getElementById('images_member_edit').src = image_adm_array
    document.getElementById('full_name_adm_edit').value = admData.full_name_adm
    document.getElementById('email_address_adm_edit').value =
      admData.email_address_adm
    document.getElementById('number_phone_adm_edit').value =
      admData.number_phone_adm
    document.getElementById('permissions_adm_edit').value =
      admData.permissions_adm
  }
}

cardEditForm.addEventListener('submit', async event => {
  event.preventDefault()
  const dataEditForm = new FormData(cardEditForm)

  // for (var dados of dataEditForm.entries()) {
  //   console.log(dados[0] + ' ' + dados[1] + ' ' + dados[2])
  // }

  dataEditForm.append('add', 1)

  const dataNewUser = await fetch(
    baseURL + 'admUserControllers.php?typeForm=edite_adm',
    {
      method: 'POST',
      body: dataEditForm
    }
  )

  const response = await dataNewUser.json()

  if (response['error']) {
    msgEditAlerta.innerHTML = response['msg']
  } else {
    msgEditAlerta.innerHTML = response['msg']
  }

  listAdm(numRegister.value)
  setTimeout(() => {
    msgEditAlerta.innerHTML = ''
  }, 4000)
})
