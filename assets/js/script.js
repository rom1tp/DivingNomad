window.addEventListener('DOMContentLoaded', () => {
	const page = document.querySelector('main').className
	switch (page) {
		case 'galleryBack':
			const locationsSelect = document.querySelector('.location')
			const continentsSelect = document.getElementById('continents')
			const countriesSelect = document.getElementById('countries')
			const countriesOptions = document.querySelectorAll('#countries option')
			const newContinentInput = document.getElementById('newContinent')
			const newCountryInput = document.getElementById('newCountry')

			function ContinentsOnChange() {
				newCountryInput.classList.remove('active')
				locationsSelect.selectedIndex = 0
				countriesSelect.selectedIndex = 0
				if (this.value == 'new') {
					newContinentInput.classList.add('active')
					newCountryInput.classList.add('active')
					countriesSelect.classList.add('active')
					countriesSelect.selectedIndex = 1
					countriesOptions.forEach((option) => {
						let value = option.getAttribute('value')
						if (value == 'new') {
							option.classList.add('active')
						} else {
							option.classList.remove('active')
						}
					})
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
				}
			}

			continentsSelect.addEventListener('change', ContinentsOnChange)

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
				newContinentInput.classList.remove('active')
				newCountryInput.classList.remove('active')
			})
			break

		case 'gallery':
			$('figure').addClass('visible')
			function filterContinent() {
				$('.continent-filters .filter').removeClass('active')
				$(this).addClass('active')
				const filter = $(this).data('filter')
				if (filter == 'all') {
					$('figure').addClass('visible')
					$('.country-filters .filter').addClass('visible')
				} else {
					$('.country-filters .filter')
						.not(`[data-continent="${filter}"]`)
						.removeClass('visible')
					$('.country-filters .filter')
						.filter(`[data-continent="${filter}"]`)
						.addClass('visible')

					$('figure').not(`[data-continent="${filter}"]`).removeClass('visible')
					$('figure').filter(`[data-continent="${filter}"]`).addClass('visible')
				}
			}

			function filterCountry() {
				$('.country-filters .filter').removeClass('active')
				$(this).addClass('active')
				const filter = $(this).data('filter')
				$('figure').not(`[data-country="${filter}"]`).removeClass('visible')
				$('figure').filter(`[data-country="${filter}"]`).addClass('visible')
			}

			$('.continent-filters .filter').on('click', filterContinent)
			$('.country-filters .filter').on('click', filterCountry)

			break

		case 'test':
			const openPhotoPicker = document.getElementById('openPhotoPicker')
			const closePhotoPicker = document.getElementById('closePhotoPicker')
			break
	}
})
