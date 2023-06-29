function redirectToSearch(event) {
  event.preventDefault() // Impede o comportamento padrão de envio do formulário

  var searchTerm = document.getElementById('searchInput').value
  var redirectUrl = '/products/search/' + encodeURIComponent(searchTerm)
  window.location.href = redirectUrl
}
