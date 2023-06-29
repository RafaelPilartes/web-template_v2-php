const baseURL = '/base/controllers/'

const currentURL = window.location.href
var searchTerm = decodeURIComponent(currentURL.split('/products/search/')[1])

const containerProducts = document.getElementById('container_products')

const searchTerm1 = (document.getElementById('searchTerm1').innerText =
  searchTerm)
const searchTerm2 = (document.getElementById('searchTerm2').innerText =
  searchTerm)

const numRegister = document.getElementById('numRegister')
const searchRegister = document.getElementById('searchRegister')
const searchRegisterForm = document.getElementById('searchRegister')
const searchRegisterValue = document.getElementById('searchRegisterValue')

const listProductSearch = async limitRegister => {
  const data = await fetch(
    baseURL +
      'productControllers.php?typeForm=get_products_search&numRegister=' +
      limitRegister +
      '&search_term=' +
      searchTerm
  )
  const response = await data.text()
  containerProducts.innerHTML = response
}
listProductSearch(numRegister.value)

numRegister.addEventListener('change', () => {
  listProductSearch(numRegister.value)
})
