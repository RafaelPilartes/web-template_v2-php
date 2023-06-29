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
      'categoryControllers.php?typeForm=get_all_category_search&searchRegisterValue=' +
      searchRegisterValue.value
  )

  const response = await dataFetch.json()

  if (response['error']) {
    listCategory(numRegister.value)
    alert(response['msg'])
  } else {
    tbody.innerHTML = response['msg']
    cardForm.reset()
  }
})

const listCategory = async limitRegister => {
  const data = await fetch(
    baseURL +
      'categoryControllers.php?typeForm=get_all_category&numRegister=' +
      limitRegister
  )
  const response = await data.text()
  tbody.innerHTML = response
}
listCategory(numRegister.value)

numRegister.addEventListener('change', () => {
  listCategory(numRegister.value)
})

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'categoryControllers.php?typeForm=create_category',
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
    listCategory(numRegister.value)
  }

  listCategory(numRegister.value)
  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})

async function confirmDelete(idCategory) {
  await fetch(
    baseURL +
      'categoryControllers.php?typeForm=delete_category&idCategory=' +
      idCategory
  )
  listCategory(numRegister.value)
}

function deleteCategory(idCategory) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar esta categoria?',
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
        confirmDelete(idCategory)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'categoria foi excluído.',
          'success'
        )
        listUsers()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'A categoria não foi excluído :)',
          'error'
        )
      }
    })
}

async function editeCategory(idCategory) {
  const dataFetch = await fetch(
    baseURL +
      'categoryControllers.php?typeForm=get_category&idCategory=' +
      idCategory
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const categoryData = response['dados']
    const cardModal = document.getElementById('modalEdite')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    // console.log(response['dados'])
    document.getElementById('id_edit').value = categoryData.id
    document.getElementById('name_category').value = categoryData.name_category
    document.getElementById('visibility_category').value =
      categoryData.visibility_category
  }
}

cardEditForm.addEventListener('submit', async event => {
  event.preventDefault()
  const dataEditForm = new FormData(cardEditForm)

  // for (var dados of dataEditForm.entries()) {
  //   console.log(dados[0] + ' ' + dados[1] + ' ' + dados[2])
  // }

  dataEditForm.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'categoryControllers.php?typeForm=edite_category',
    {
      method: 'POST',
      body: dataEditForm
    }
  )

  const response = await dataNew.json()

  if (response['error']) {
    msgEditAlerta.innerHTML = response['msg']
  } else {
    msgEditAlerta.innerHTML = response['msg']
  }

  listCategory(numRegister.value)

  setTimeout(() => {
    msgEditAlerta.innerHTML = ''
  }, 4000)
})
