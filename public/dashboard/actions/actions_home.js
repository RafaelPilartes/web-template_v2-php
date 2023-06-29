const baseURL = '/dashboard/controllers/'

const tbody = document.querySelector('tbody')
const numSubscribers = document.getElementById('num_subscribers')
const numTeams = document.getElementById('num_teams')
const numMembers = document.getElementById('num_members')
const numPaid_out = document.getElementById('num_paid_out')
const numPending = document.getElementById('num_pending')
const numScheduling = document.getElementById('num_scheduling')

const getNumTeams = async () => {
  const dataFetch = await fetch(
    baseURL + 'homeController.php?typeAction=count_teams'
  )
  const response = await dataFetch.text()

  numTeams.innerText = response
}
getNumTeams()
const getNumMembers = async () => {
  const dataFetch = await fetch(
    baseURL + 'homeController.php?typeAction=count_members'
  )
  const response = await dataFetch.text()

  numMembers.innerText = response
}
getNumMembers()

const getPaidOut = async () => {
  await fetch(baseURL + 'homeController.php?typeAction=count_paid_out')
    .then(response => response.json())
    .then(data => {
      // Array para armazenar os valores do campo value_payment_team
      const valueTotalPay = []

      // Itera sobre os dados das pagamento
      data.forEach(paid => {
        console.log(paid)
        valueTotalPay.push(paid.value_payment_team)
      })

      const sumTotalPay = valueTotalPay.reduce(
        (acumulador, valor) => acumulador + valor,
        0
      )

      const formattedSum = sumTotalPay.toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      })

      numPaid_out.textContent = formattedSum
    })
}
getPaidOut()

const getPaidPending = async () => {
  await fetch(baseURL + 'homeController.php?typeAction=count_paid_pending')
    .then(response => response.json())
    .then(data => {
      // Array para armazenar os valores do campo value_payment_team
      const valueTotalPay = []

      // Itera sobre os dados das pagamento
      data.forEach(paid => {
        console.log(paid)
        valueTotalPay.push(paid.value_payment_team)
      })

      const sumTotalPay = valueTotalPay.reduce(
        (acumulador, valor) => acumulador + valor,
        0
      )

      const formattedSum = sumTotalPay.toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      })

      numPending.textContent = formattedSum
    })
}
getPaidPending()

const listMembers = async () => {
  const dataFetch = await fetch(
    baseURL + 'homeController.php?typeAction=get_team'
  )

  const response = await dataFetch.text()

  tbody.innerHTML = response
}
listMembers()
