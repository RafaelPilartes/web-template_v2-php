const baseURL = '/base/controllers/'

const containerProducts = document.getElementById('container_products')

const numRegister = document.getElementById('numRegister')
const searchRegister = document.getElementById('searchRegister')
const searchRegisterForm = document.getElementById('searchRegister')
const searchRegisterValue = document.getElementById('searchRegisterValue')

// searchRegisterForm.addEventListener('submit', async event => {
//   event.preventDefault()

//   const dataForm = new FormData(searchRegisterForm)
//   dataForm.append('add', 1)

//   const dataFetch = await fetch(
//     baseURL +
//       'productControllers.php?typeForm=get_all_product_search&searchRegisterValue=' +
//       searchRegisterValue.value
//   )

//   const response = await dataFetch.json()

//   if (response['error']) {
//     listProduct(numRegister.value)
//     alert(response['msg'])
//   } else {
//     containerProducts.innerHTML = response['msg']
//     searchRegisterForm.reset()
//   }
// })

const listProduct = async limitRegister => {
  const data = await fetch(
    baseURL +
      'productControllers.php?typeForm=get_all_product&numRegister=' +
      limitRegister
  )
  const response = await data.text()
  containerProducts.innerHTML = response
}
listProduct(numRegister.value)

numRegister.addEventListener('change', () => {
  listProduct(numRegister.value)
})
