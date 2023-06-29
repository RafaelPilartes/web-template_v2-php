const baseURL = '/base/controllers/'

const containerProductsTabs = document.getElementById('container_products_tabs')
const containerProductsFeatured = document.getElementById(
  'container_products_featured'
)

const listProductBestseller = async limitRegister => {
  const data = await fetch(
    baseURL +
      'productListControllers.php?typeForm=bestseller_products&numRegister=' +
      limitRegister
  )
  const response = await data.text()
  containerProductsTabs.innerHTML = response
}
listProductBestseller(3)
const listProductNewArrivals = async limitRegister => {
  const data = await fetch(
    baseURL +
      'productListControllers.php?typeForm=new_arrivals_products&numRegister=' +
      limitRegister
  )
  const response = await data.text()
  containerProductsTabs.innerHTML = response
}
const listProductTopRated = async limitRegister => {
  const data = await fetch(
    baseURL +
      'productListControllers.php?typeForm=featured_products&numRegister=' +
      limitRegister
  )
  const response = await data.text()
  containerProductsTabs.innerHTML = response
}

const listProductFeatured = async limitRegister => {
  const data = await fetch(
    baseURL +
      'productListControllers.php?typeForm=featured_products&numRegister=' +
      limitRegister
  )
  const response = await data.text()
  containerProductsFeatured.innerHTML = response
}
listProductFeatured(8)
