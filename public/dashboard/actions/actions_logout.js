const base_URL = '/dashboard/controllers/'

const nameAdmStorage = localStorage.getItem('adm_deal_days_name')
const emailAdmStorage = localStorage.getItem('adm_deal_days_email')

const nameAdm = document.getElementById('name_adm')
const emailAdm = document.getElementById('email_adm')
const logout = document.getElementById('logout')

nameAdm.innerText = nameAdmStorage
emailAdm.innerText = emailAdmStorage

logout.addEventListener('click', async () => {
  const dataAdm = await fetch(
    base_URL + 'admControllers.php?type_form=logout_adm'
  )

  location.reload()
})
