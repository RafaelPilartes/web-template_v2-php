const baseURL = '/dashboard/controllers/'

const currentURL = window.location.href
const parts = currentURL.split('/')
const lastPart = parts[parts.length - 1]

const tbodyMember = document.getElementById('tbodyMember')

const msgAlerta = document.getElementById('msgAlertaErroCad')
const msgEditTeamAlerta = document.getElementById('msgEditTeamAlerta')
const msgEditMemberAlerta = document.getElementById('msgEditMemberAlerta')
const cardMemberEditForm = document.getElementById('memberEditForm')
const cardTeamEditForm = document.getElementById('teamEditForm')
const cardEditForm = document.getElementById('editForm')

async function getMember(idMember) {
  const dataFetch = await fetch(
    baseURL +
      'memberControllers.php?typeForm=get_all_member&idMember=' +
      idMember
  )

  const response = await dataFetch.json()

  if (response['error']) {
    tbodyMember.innerHTML = response['msg']
  } else {
    tbodyMember.innerHTML = response['msg']
  }
}
getMember(lastPart)

async function confirmDelete(idMember) {
  await fetch(
    baseURL +
      'memberControllers.php?typeForm=delete_member&idMember=' +
      idMember
  )
}
function deleteMember(idMember) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar este membro?',
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
        confirmDelete(idMember)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'Member foi excluído.',
          'success'
        )
        getMember(lastPart)
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'O membro não foi excluído :)',
          'error'
        )
      }
    })
}
async function seeMember(idMember) {
  const dataFetch = await fetch(
    baseURL + 'memberControllers.php?typeForm=get_member&idMember=' + idMember
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const memberData = response['dados']
    const cardModal = document.getElementById('memberSeeModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    document.getElementById('name_integrante_team_see').value =
      memberData.name_member
    document.getElementById('identity_card_integrante_team_see').value =
      memberData.identity_card_member
    document.getElementById('nif_integrante_team_see').value =
      memberData.nif_member
    document.getElementById('age_integrante_team_see').value =
      memberData.age_member
    document.getElementById('telephone_integrante_team_see').value =
      memberData.telephone_member
    document.getElementById('household_integrante_team_see').value =
      memberData.household_member
    document.getElementById('email_integrante_team_see').value =
      memberData.email_member
    document.getElementById('province_integrante_team_see').value =
      memberData.province_member
    document.getElementById('county_integrante_team_see').value =
      memberData.county_member
    document.getElementById('university_integrante_team_see').value =
      memberData.university_member
    document.getElementById('school_integrante_team_see').value =
      memberData.school_member
    document.getElementById('course_integrante_team_see').value =
      memberData.course_member
    document.getElementById('year_attend_integrante_team_see').value =
      memberData.year_attend_member

    document.getElementById('company_member_team_see').value =
      memberData.company_member
    document.getElementById('function_member_team_see').value =
      memberData.function_member
    document.getElementById('skills_member_team_see').value =
      memberData.skills_member
  }
}

async function editMember(idMember) {
  const dataFetch = await fetch(
    baseURL + 'memberControllers.php?typeForm=get_member&idMember=' + idMember
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const memberData = response['dados']
    const cardModal = document.getElementById('memberEditModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    document.getElementById('id_edit').value = memberData.id
    document.getElementById('name_integrante_team_edit').value =
      memberData.name_member
    document.getElementById('identity_card_integrante_team_edit').value =
      memberData.identity_card_member
    document.getElementById('nif_integrante_team_edit').value =
      memberData.nif_member
    document.getElementById('age_integrante_team_edit').value =
      memberData.age_member
    document.getElementById('telephone_integrante_team_edit').value =
      memberData.telephone_member
    document.getElementById('household_integrante_team_edit').value =
      memberData.household_member
    document.getElementById('email_integrante_team_edit').value =
      memberData.email_member

    document.getElementById('company_integrante_team').value =
      memberData.company_member
    document.getElementById('function_integrante_team').value =
      memberData.function_member
    document.getElementById('skills_integrante_team').value =
      memberData.skills_member
  }
}
cardMemberEditForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataFetch = new FormData(cardMemberEditForm)

  for (var dados of dataFetch.entries()) {
    console.log(dados[0] + ' -> ' + dados[1])
  }

  dataFetch.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'memberControllers.php?typeForm=edite_member',
    {
      method: 'POST',
      body: dataFetch
    }
  )

  const response = await dataNew.json()

  if (response['error']) {
    msgEditMemberAlerta.innerHTML = response['msg']
  } else {
    msgEditMemberAlerta.innerHTML = response['msg']
  }

  setTimeout(() => {
    msgEditMemberAlerta.innerHTML = ''
  }, 4000)

  getMember(lastPart)
})

// >>>>>> TEAM <<<<<
async function getTeam(idTeam) {
  const dataFetch = await fetch(
    baseURL + 'teamControllers.php?typeForm=get_team&idTeam=' + idTeam
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const teamData = response['dados']

    const formattedSum = teamData.value_payment_team.toLocaleString('pt-BR', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    })

    document.getElementById('nameTeamH1').innerText = teamData.name_team
    document.getElementById('nameTeamA').innerText = teamData.name_team

    document.getElementById('id_team_list').innerText = teamData.id
    document.getElementById('name_team_list').innerText = teamData.name_team
    document.getElementById('type_team_list').innerText = teamData.type_team
    document.getElementById('amount_members_list').innerText =
      teamData.amount_members_team
    document.getElementById('value_payment_team_list').innerText = formattedSum

    const statusPaymentTeam = document.getElementById(
      'status_payment_team_list'
    )
    statusPaymentTeam.innerText = teamData.status_payment_team

    let state_is = ''

    if (teamData.status_payment_team == 'Pago') {
      state_is = 'completed'
    } else {
      state_is = 'pending'
    }

    statusPaymentTeam.classList.add(state_is)
  }
}
getTeam(lastPart)

async function editTeam(idTeam) {
  const dataFetch = await fetch(
    baseURL + 'teamControllers.php?typeForm=get_team&idTeam=' + lastPart
  )

  const response = await dataFetch.json()

  if (response['error']) {
    alert(response['msg'])
  } else {
    const teamData = response['dados']
    const cardModal = document.getElementById('teamEditModal')

    cardModal.style.visibility = 'visible'
    cardModal.classList.add('show')

    const formattedSum = teamData.value_payment_team.toLocaleString('pt-BR', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    })

    document.getElementById('id_edit_team').value = teamData.id
    document.getElementById('name_team').value = teamData.name_team
    document.getElementById('amount_members').value =
      teamData.amount_members_team
    document.getElementById('value_payment_team').value = formattedSum
    document.getElementById('status_payment_team').value =
      teamData.status_payment_team
  }
}
cardTeamEditForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataFetch = new FormData(cardTeamEditForm)

  // for (var dados of dataFetch.entries()) {
  //   console.log(dados[0] + ' ' + dados[1] + ' ' + dados[2])
  // }

  dataFetch.append('add', 1)

  const dataNew = await fetch(
    baseURL + 'teamControllers.php?typeForm=edite_team',
    {
      method: 'POST',
      body: dataFetch
    }
  )

  const response = await dataNew.json()

  if (response['error']) {
    msgEditTeamAlerta.innerHTML = response['msg']
  } else {
    msgEditTeamAlerta.innerHTML = response['msg']
  }

  setTimeout(() => {
    msgEditTeamAlerta.innerHTML = ''
  }, 4000)

  getTeam(lastPart)
})
async function confirmTeamDelete(idTeam) {
  await fetch(
    baseURL + 'teamControllers.php?typeForm=delete_team&idTeam=' + lastPart
  )
}
function deleteTeam(idTeam) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar está faculdade?',
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
        confirmTeamDelete(lastPart)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'Team foi excluído.',
          'success'
        )

        window.location.reload()
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'A faculdade não foi excluído :)',
          'error'
        )
      }
    })
}
