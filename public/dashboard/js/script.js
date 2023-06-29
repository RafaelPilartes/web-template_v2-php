const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a')

// allSideMenu.forEach(item => {
//   const li = item.parentElement

//   item.addEventListener('click', function () {
//     allSideMenu.forEach(i => {
//       i.parentElement.classList.remove('active')
//     })
//     li.classList.add('active')
//   })
// })

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu')
const sidebar = document.getElementById('sidebar')

menuBar.addEventListener('click', function () {
  sidebar.classList.toggle('hide')
})

const searchButton = document.querySelector(
  '#content nav form .form-input button'
)
const searchButtonIcon = document.querySelector(
  '#content nav form .form-input button .bx'
)
const searchForm = document.querySelector('#content nav form')

searchButton.addEventListener('click', function (e) {
  if (window.innerWidth < 576) {
    e.preventDefault()
    searchForm.classList.toggle('show')
    if (searchForm.classList.contains('show')) {
      searchButtonIcon.classList.replace('bx-search', 'bx-x')
    } else {
      searchButtonIcon.classList.replace('bx-x', 'bx-search')
    }
  }
})

if (window.innerWidth < 768) {
  sidebar.classList.add('hide')
} else if (window.innerWidth > 576) {
  searchButtonIcon.classList.replace('bx-x', 'bx-search')
  searchForm.classList.remove('show')
}

window.addEventListener('resize', function () {
  if (this.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search')
    searchForm.classList.remove('show')
  }
})

const switchMode = document.getElementById('switch-mode')

switchMode.addEventListener('change', function () {
  if (this.checked) {
    document.body.classList.add('dark')
  } else {
    document.body.classList.remove('dark')
  }
})

// MODAL
// obter os elementos HTML
var buttons = document.querySelectorAll('[data-toggle="modal"]')
var modals = document.querySelectorAll('.modal')

// adicionar um event listener para cada botão
buttons.forEach(function (button) {
  button.addEventListener('click', function () {
    // obter o alvo do modal a partir do atributo "data-target" do botão
    var target = this.getAttribute('data-target')
    // selecionar o modal correspondente
    var modal = document.querySelector(target)
    // exibir o modal
    modal.style.visibility = 'visible'
    modal.classList.add('show')
  })
})

// adicionar um event listener para fechar o modal
modals.forEach(function (modal) {
  modal.addEventListener('click', function (event) {
    // verificar se o usuário clicou no botão de fechar ou no fundo do modal
    if (event.target == modal || event.target.classList.contains('close')) {
      // fechar o modal
      modal.style.visibility = 'hidden'
      modal.classList.remove('show')
    }
  })
})
