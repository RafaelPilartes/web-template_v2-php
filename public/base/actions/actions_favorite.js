const newBaseURL = '/base/controllers/'

const addToFavorite = async idProduct => {
  const dataFetch = await fetch(
    newBaseURL +
      'favoriteControllers.php?typeForm=add_to_favorite&id_product=' +
      idProduct
  )

  const response = await dataFetch.json()

  if (response['error']) {
    console.log(result)

    Toastify({
      text: response['msg'],
      duration: 3000,
      // destination: 'https://github.com/apvarun/toastify-js',
      // newWindow: true,
      close: true,
      gravity: 'top',
      position: 'right',
      stopOnFocus: true,
      style: {
        // background: 'red'
        // background: 'linear-gradient(to right, #00b09b, #3d7ac9)'
      },
      onClick: function () {} // Callback after click
    }).showToast()
  } else {
    Toastify({
      text: response['msg'],
      duration: 3000,
      // destination: 'https://github.com/apvarun/toastify-js',
      // newWindow: true,
      close: true,
      gravity: 'top',
      position: 'right',
      stopOnFocus: true,
      style: {
        // background: 'red'
        // background: 'linear-gradient(to right, #00b09b, #3d7ac9)'
      },
      onClick: function () {} // Callback after click
    }).showToast()
  }

  // const response = await dataFetch.text()
  // containerProducts.innerHTML = response
}

const countFavorites = async emailCustomer => {
  const dataFetch = await fetch(
    baseURL +
      'favoriteControllers.php?typeForm=count_favorites&email_customer=' +
      emailCustomer
  )

  const response = await dataFetch.text()

  document.getElementById('countFavorites').innerHTML = response
}
countFavorites()
