const locationsSelect = document.querySelector('.location')
const continentsSelect = document.getElementById('continents')
const countriesSelect = document.getElementById('countries')
const countriesOptions = document.querySelectorAll('#countries option')
const newContinentInput = document.getElementById('newContinent')
const newCountryInput = document.getElementById('newCountry')

function displayCountries() {
  locationsSelect.selectedIndex = 0
  countriesSelect.selectedIndex = 0
  if (this.value == 'new') {
    newContinentInput.classList.add('active')
    countriesSelect.classList.remove('active')
  } else {
    newContinentInput.classList.remove('active')
    countriesSelect.classList.add('active')
    const continentSelected = $(
      '#continents option:selected'
    )[0].getAttribute('data-continent')
    countriesOptions.forEach((option) => {
      let continent = option.getAttribute('data-continent')
      if (continentSelected == continent) {
        option.classList.add('active')
      } else {
        option.classList.remove('active')
      }
    })
  }}

window.addEventListener('DOMContentLoaded', () => {
	continentsSelect.addEventListener('change', displayCountries)

	countriesSelect.addEventListener('change', function () {
		if (this.value == 'new') {
			newCountryInput.classList.add('active')
		} else {
			newCountryInput.classList.remove('active')
		}
	})
  
  locationsSelect.addEventListener('change', () => {
    continentsSelect.selectedIndex = 0
    countriesSelect.selectedIndex = 0
    countriesSelect.classList.remove('active')
  })
})
