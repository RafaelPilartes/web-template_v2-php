const baseURL = '/base/controllers/'

const currentURL = window.location.href
const parts = currentURL.split('/')
const lastPart = parts[parts.length - 1]

var searchCategory = decodeURIComponent(
  currentURL.split('/products/category/')[1]
)
const searchCategory1 = (document.getElementById('searchCategory1').innerText =
  searchCategory)
const searchCategory2 = (document.getElementById('searchCategory2').innerText =
  searchCategory)

const containerProducts = document.getElementById('container_products')

const numRegister = document.getElementById('numRegister')
const searchRegister = document.getElementById('searchRegister')
const searchRegisterForm = document.getElementById('searchRegister')
const searchRegisterValue = document.getElementById('searchRegisterValue')

const listProductCategory = async limitRegister => {
  const data = await fetch(
    baseURL +
      'productControllers.php?typeForm=get_product_category&numRegister=' +
      limitRegister +
      '&category_product=' +
      lastPart
  )
  const response = await data.text()
  containerProducts.innerHTML = response
}
listProductCategory(numRegister.value)

numRegister.addEventListener('change', () => {
  listProductCategory(numRegister.value)
})
