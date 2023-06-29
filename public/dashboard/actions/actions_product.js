const baseURL = '/dashboard/controllers/'

const tbody = document.getElementById('all_records')

const msgAlerta = document.getElementById('msgAlertaErroCad')
const cardForm = document.getElementById('registerForm')
const cardEditForm = document.getElementById('editForm')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCard')

const categorySelect = document.getElementById('category_select')
const categoryEditSelect = document.getElementById('category_product_edite')

const numRegister = document.getElementById('numRegister')
const searchRegister = document.getElementById('searchRegister')
const searchRegisterForm = document.getElementById('searchRegister')
const searchRegisterValue = document.getElementById('searchRegisterValue')

const inputImagens = document.getElementById('inputImagens')
const containerImagens = document.getElementById('containerImagens')
const inputImagensEdit = document.getElementById('inputImagensEdit')
const containerImagensEdit = document.getElementById('containerImagensEdit')

const productStoreSelect = document.getElementById('product_store_select')
const linkProductContainer = document.getElementById('link_product_container')
const linkProduct = document.getElementById('link_product')

const productStoreSelectEdit = document.getElementById(
  'product_store_select_edit'
)
const linkProductContainerEdit = document.getElementById(
  'link_product_container_edit'
)
const linkProductEdit = document.getElementById('link_product_edit')

const characteristicNames = document.querySelectorAll(
  '[name="characteristic_name[]"]'
)
const characteristicValues = document.querySelectorAll(
  '[name="characteristic_value[]"]'
)

const containerCharacteristicsProductEdit = document.getElementById(
  'characteristics-container-edit'
)
const containerCharacteristicsProduct = document.getElementById(
  'characteristics-container-see'
)

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

searchRegisterForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(searchRegisterForm)
  dataForm.append('add', 1)

  const dataFetch = await fetch(
    baseURL +
      'productControllers.php?typeForm=get_all_product_search&searchRegisterValue=' +
      searchRegisterValue.value
  )

  const response = await dataFetch.json()

  if (response['error']) {
    listProduct(numRegister.value)
    alert(response['msg'])
  } else {
    tbody.innerHTML = response['msg']
    searchRegisterForm.reset()
  }
})

const listProduct = async limitRegister => {
  console.log('12345678')

  const data = await fetch(
    baseURL +
      'productControllers.php?typeForm=get_all_product&numRegister=' +
      limitRegister
  )
  const response = await data.text()
  tbody.innerHTML = response
}
listProduct(numRegister.value)

const listCategory = async () => {
  await fetch(baseURL + 'productControllers.php?typeForm=get_all_category')
    .then(response => response.json())
    .then(data => {
      // Itera sobre os dados retornados e adiciona opções ao select
      data.forEach(row => {
        const option = document.createElement('option')
        const optionEdit = document.createElement('option')
        option.text = row.name_category
        option.value = row.name_category
        optionEdit.value = row.name_category
        optionEdit.text = row.name_category
        categorySelect.add(option)
        categoryEditSelect.add(optionEdit)
      })
    })
    .catch(error => console.error('Erro:', error))
}
listCategory()

numRegister.addEventListener('change', () => {
  listProduct(numRegister.value)
})

productStoreSelect.addEventListener('change', () => {
  const isProductStore = productStoreSelect.value

  if (isProductStore == 'no') {
    linkProductContainer.hidden = false
    linkProduct.disabled = false
  } else {
    linkProductContainer.hidden = true
    linkProduct.disabled = true
  }
})
productStoreSelectEdit.addEventListener('change', () => {
  const isProductStoreEdit = productStoreSelectEdit.value

  if (isProductStoreEdit == 'no') {
    linkProductContainerEdit.hidden = false
    linkProductEdit.disabled = false
  } else {
    linkProductContainerEdit.hidden = true
    linkProductEdit.disabled = true
  }
})

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'productControllers.php?typeForm=create_product',
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
    listProduct(numRegister.value)
  }

  console.log(response['msg'])

  listProduct(numRegister.value)
  closeModalEdit()

  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})

async function confirmDelete(idProduct) {
  await fetch(
    baseURL +
      'productControllers.php?typeForm=delete_product&idProduct=' +
      idProduct
  )
  listProduct(numRegister.value)
}

function deleteProduct(idProduct) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar esta produto?',
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
        confirmDelete(idProduct)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'Produto foi excluído.',
          'success'
        )
        listUsers()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'A produto não foi excluído :)',
          'error'
        )
      }
    })
}

async function seeProduct(idProduct) {
  const dataFetch = await fetch(
    baseURL +
      'productControllers.php?typeForm=get_product&idProduct=' +
      idProduct
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const subDataFetch = await fetch(
      baseURL +
        'productControllers.php?typeForm=get_all_characteristics&idProduct=' +
        idProduct
    )

    const subResponse = await subDataFetch.json()

    const productData = response['dados']
    const characteristicsData = subResponse

    const cardModal = document.getElementById('modalSee')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    containerCharacteristicsProduct.innerHTML = ''

    // console.log(response['dados'])
    const images_product_array = JSON.parse(productData.images_product)

    document.getElementById('id_see').value = productData.id
    document.getElementById('images_product_see').src = images_product_array[0]

    document.getElementById('name_product_see').value = productData.name_product
    document.getElementById('description_product_see').value =
      productData.description_product
    document.getElementById('old_price_product_see').value =
      productData.old_price_product
    document.getElementById('new_price_product_see').value =
      productData.new_price_product
    document.getElementById('category_product_see').value =
      productData.category_product
    document.getElementById('stock_product_see').value =
      productData.stock_product

    document.getElementById('product_store_see').value =
      productData.product_store == 'yes' ? 'Sim' : 'Não'
    document.getElementById('link_product_see').value =
      productData.link_product == 'yes' ? 'Sim' : 'Não'
    document.getElementById('is_best_sellers_see').value =
      productData.is_best_sellers == 'yes' ? 'Sim' : 'Não'
    document.getElementById('is_new_arrivals_see').value =
      productData.is_new_arrivals == 'yes' ? 'Sim' : 'Não'
    document.getElementById('is_top_rated_see').value =
      productData.is_top_rated == 'yes' ? 'Sim' : 'Não'

    if (subResponse['error']) {
      alert(subResponse['msg'])
    } else {
      for (let index = 0; index < characteristicsData.length; index++) {
        let characteristics = characteristicsData[index]
        const rowCharacteristic = document.createElement('tr')
        rowCharacteristic.innerHTML = `
          <td> ${characteristics.name_characteristic} </td>
          <td> ${characteristics.value_characteristic} </td>
       `
        containerCharacteristicsProduct.appendChild(rowCharacteristic)
      }
    }
  }
}

async function editeProduct(idProduct) {
  const dataFetch = await fetch(
    baseURL +
      'productControllers.php?typeForm=get_product&idProduct=' +
      idProduct
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const subDataFetch = await fetch(
      baseURL +
        'productControllers.php?typeForm=get_all_characteristics&idProduct=' +
        idProduct
    )

    const subResponse = await subDataFetch.json()

    const productData = response['dados']
    const characteristicsData = subResponse

    const cardModal = document.getElementById('modalEdite')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    containerCharacteristicsProductEdit.innerHTML = ''

    const images_product_array = JSON.parse(productData.images_product)
    document.getElementById('id_edite').value = productData.id
    document.getElementById('images_product_edit').src = images_product_array[0]

    document.getElementById('name_product_edite').value =
      productData.name_product
    document.getElementById('description_product_edite').value =
      productData.description_product
    document.getElementById('old_price_product_edite').value =
      productData.old_price_product
    document.getElementById('new_price_product_edite').value =
      productData.new_price_product
    document.getElementById('category_product_edite').value =
      productData.category_product
    document.getElementById('stock_product_edite').value =
      productData.stock_product

    document.getElementById('product_store_select_edit').value =
      productData.product_store
    document.getElementById('link_product_edit').value =
      productData.link_product
    document.getElementById('is_best_sellers_select_edit').value =
      productData.is_best_sellers
    document.getElementById('is_new_arrivals_select_edit').value =
      productData.is_new_arrivals
    document.getElementById('is_top_rated_select_edit').value =
      productData.is_top_rated

    const productStoreSelectEditNow = document.getElementById(
      'product_store_select_edit'
    )
    const isProductStoreEdit = productStoreSelectEditNow.value

    if (isProductStoreEdit == 'no') {
      linkProductContainerEdit.hidden = false
      linkProductEdit.disabled = false
    } else {
      linkProductContainerEdit.hidden = true
      linkProductEdit.disabled = true
    }

    if (subResponse['error']) {
      // alert(subResponse['msg'])
    } else {
      for (let index = 0; index < characteristicsData.length; index++) {
        let characteristics = characteristicsData[index]
        const rowCharacteristic = document.createElement('div')
        rowCharacteristic.innerHTML = `
          <div class="rowItems">
            <div class="characteristic-input col-md-5 p-sm-0">
              <label for="characteristic-name-0">Nome da Característica ${
                index + 1
              }:</label>
              <input name="name_characteristic[]" value="${
                characteristics.name_characteristic
              }" type="text" id="characteristic-name-0"
                class="form-control characteristic-name" required readonly />
            </div>
            <div class="characteristic-input col-md-6 p-sm-0">
              <label for="characteristic-value-0">Valor da Característica ${
                index + 1
              }:</label>
              <input name="value_characteristic[]" value="${
                characteristics.value_characteristic
              }" type="text" id="characteristic-value-0"
                class="form-control characteristic-value" required />
            </div>

            <button class="removeCharacteristicBtn btn-delete">
            <i class='fas fa-trash-alt'></i>
          </button>
        </div>
     `
        containerCharacteristicsProductEdit.appendChild(rowCharacteristic)

        const removeCharacteristicBtns = document.getElementsByClassName(
          'removeCharacteristicBtn'
        )
        for (const btn of removeCharacteristicBtns) {
          btn.addEventListener('click', function () {
            deleteCharacteristic(characteristics.id)

            this.parentNode.remove()
          })
        }
      }
    }
  }
}

cardEditForm.addEventListener('submit', async event => {
  event.preventDefault()
  const dataEditForm = new FormData(cardEditForm)

  for (var dados of dataEditForm.entries()) {
    console.log(dados[0] + ' -> ' + dados[1])
  }

  dataEditForm.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'productControllers.php?typeForm=edite_product',
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

  listProduct(numRegister.value)

  setTimeout(() => {
    msgEditAlerta.innerHTML = ''
  }, 4000)
})

async function deleteCharacteristic(idCharacteristic) {
  const dataFetch = await fetch(
    baseURL +
      'productControllers.php?typeForm=delete_characteristic&idCharacteristic=' +
      idCharacteristic
  )

  const response = await dataFetch.json()

  alert(response.msg)
  closeModalEdit()
}

function openModalEdit() {
  const cadModal = document.getElementById('modalEdite')

  cadModal.style.visibility = 'visible'
  cadModal.classList.add('show')
}
function closeModalEdit() {
  const cadModal = document.getElementById('modalEdite')

  cadModal.style.visibility = 'visible'
  cadModal.classList.remove('show')
}

// Characteristics
const characteristicsContainer = document.getElementById(
  'characteristics-container'
)
const addCharacteristicButton = document.getElementById(
  'add-characteristic-button'
)
// Characteristics Edit
const characteristicsContainerEdit = document.getElementById(
  'characteristics-container-edit'
)
const addCharacteristicButtonEdit = document.getElementById(
  'add-characteristic-button-edit'
)

let characteristicIndex = 2 // Índice inicial para as características

// Função para adicionar uma nova entrada de características
function addCharacteristicInput() {
  const characteristicInput = document.createElement('div')
  characteristicInput.classList.add('characteristic-input')

  characteristicInput.innerHTML = `
    <div class="rowItems">
      <div class="characteristic-input col-md-5 p-sm-0">
        <label for="characteristic-name[]">Nome da Característica ${characteristicIndex}:</label>
        <input name="name_characteristic[]" type="text" id="characteristic-name[]" class="characteristic-name form-control" required>
      </div>
      <div class="characteristic-input col-md-6 p-sm-0">
        <label for="characteristic-value[]">Valor da Característica ${characteristicIndex}:</label>
        <input name="value_characteristic[]" type="text" id="characteristic-value[]" class="characteristic-value form-control" required>
      </div>
      <button class="removeCharacteristicBtn btn-delete">
        <i class='fas fa-trash-alt'></i>
      </button>
    </div>
  `

  characteristicsContainer.appendChild(characteristicInput)

  const removeCharacteristicBtns = document.getElementsByClassName(
    'removeCharacteristicBtn'
  )
  for (const btn of removeCharacteristicBtns) {
    btn.addEventListener('click', function () {
      this.parentNode.remove()
    })
  }

  characteristicIndex++
}

// Adiciona uma entrada de características quando o botão é clicado
addCharacteristicButton.addEventListener('click', addCharacteristicInput)

// Função para adicionar uma nova entrada de características
function addCharacteristicInputEdit() {
  const characteristicInput = document.createElement('div')
  characteristicInput.classList.add('characteristic-input')

  characteristicInput.innerHTML = `
    <div class="rowItems">
      <div class="characteristic-input col-md-5 p-sm-0">
        <label for="characteristic-name[]">Nome da Característica:</label>
        <input name="name_characteristic[]" type="text" id="characteristic-name[]" class="characteristic-name form-control" required>
      </div>
      <div class="characteristic-input col-md-6 p-sm-0">
        <label for="characteristic-value[]">Valor da Característica:</label>
        <input name="value_characteristic[]" type="text" id="characteristic-value[]" class="characteristic-value form-control" required>
      </div>
      <button class="removeCharacteristicBtn btn-delete">
        <i class='fas fa-trash-alt'></i>
      </button>
    </div>
  `

  characteristicsContainerEdit.appendChild(characteristicInput)

  const removeCharacteristicBtns = document.getElementsByClassName(
    'removeCharacteristicBtn'
  )
  for (const btn of removeCharacteristicBtns) {
    btn.addEventListener('click', function () {
      this.parentNode.remove()
    })
  }

  characteristicIndex++
}

// Adiciona uma entrada de características quando o botão é clicado
addCharacteristicButtonEdit.addEventListener(
  'click',
  addCharacteristicInputEdit
)
