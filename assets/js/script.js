window.addEventListener('DOMContentLoaded', () => {
	const page = document.querySelector('main').className

	if (page.endsWith('Back')) {
		let imgNumber
		$(`input[name="display"][type='checkbox']`).each(function () {
			// $(this).css('display', 'none')
		})
		$('.confirmOverlay #close, #cancel, #confirm').click(() => {
			$('.confirmOverlay').removeClass('visible')
		})

		$('a[href^="delete"]').on('click', function (event) {
			event.preventDefault()
			$('.confirmOverlay').addClass('visible')

			$('#confirm').on('click', () => {
				$('.confirmOverlay').removeClass('visible')
				window.location = $(this).attr('href')
			})
		})

		$('.fa-eye').click(function () {
			let id = $(this).data('id')
			$(this).removeClass('visible')
			$(`.fa-eye-slash[data-id="${id}"]`).addClass('visible')
			let checkbox = $(`input[value="show"][data-id="${id}"]`)[0]
			$(checkbox).removeAttr('checked')
		})

		$('.fa-eye-slash').click(function () {
			let id = $(this).data('id')
			$(`.fa-eye[data-id="${id}"]`).addClass('visible')
			$(this).removeClass('visible')
			let checkbox = $(`input[value="show"][data-id="${id}"]`)[0]
			$(checkbox).attr('checked', '')
		})

		$('#imgPickerOpen1, #imgPickerOpen2, #imgPickerOpen3').click(function () {
			imgPickerId = $(this)[0].id.slice(-1)
			console.log(imgPickerId)
			$('#imgPickerOverlay').addClass('visible')
		})

		$('#imgPickerOverlay #cancel, #close').click(function () {
			$('#imgPickerOverlay').removeClass('visible')
		})

		$('#imgPickerContent figure').click(function () {
			$('#imgPickerContent figure').removeClass('active')
			$(this).addClass('active')
		})

		$('#imgPickerOverlay #confirm').click(function () {
			let chosenImgId = $('#imgPickerContent figure.active').data('id')
			console.log(imgPickerId)
			$('#imgPickerOverlay').removeClass('visible')
			fetch(`getImgSrc-id-${chosenImgId}`)
				.then((response) => {
					// FIXME json contains prepos.js for some reason
					// return response.json()
					return response.text()
				})
				.then((src) => {
					// src = src.slice(38)
					console.log(src)
					document.getElementById(`src${imgPickerId}`).setAttribute('src', src)
					document
						.getElementById(`id${imgPickerId}`)
						.setAttribute('value', chosenImgId)
				})
		})
	}

	switch (page) {
		case 'galleryBack':
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

		case 'photoBack':
			const locationsSelect = document.querySelector('.location')
			const continentsSelect = document.getElementById('continents')
			const countriesSelect = document.getElementById('countries')
			const countriesOptions = document.querySelectorAll('#countries option')
			const newContinentInput = document.getElementById('newContinent')
			const newCountryInput = document.getElementById('newCountry')
			console.log(continentsSelect)

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
			console.log('hi')
			continentsSelect.addEventListener('change', ContinentsOnChange)
			console.log('hi')
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

		case 'post':
			document.querySelector(
				'.post .plx-1'
			).style.backgroundImage = `url('${document
				.querySelector('.post .plx-1 img')
				.getAttribute('data-src')}')`
			document.querySelector(
				'.post .plx-2'
			).style.backgroundImage = `url('${document
				.querySelector('.post .plx-2 img')
				.getAttribute('data-src')}')`
			document.querySelector(
				'.post .plx-3'
			).style.backgroundImage = `url('${document
				.querySelector('.post .plx-3 img')
				.getAttribute('data-src')}')`
			break

		case 'project':
			document.querySelector(
				'.project .plx-1'
			).style.backgroundImage = `url('${document
				.querySelector('.project .plx-1 img')
				.getAttribute('data-src')}')`
			// document.querySelector('.project .plx-2').style.backgroundImage = `url('${document.querySelector('.project .plx-2 img').getAttribute('data-src')}')`
			// document.querySelector('.project .plx-3').style.backgroundImage = `url('${document.querySelector('.project .plx-3 img').getAttribute('data-src')}')`
			break

		case 'projectBack':
			$('.fa-eye').click(function () {
				$(this).removeClass('visible')
				$(`.fa-eye-slash`).addClass('visible')
				let checkbox = $(`input[value="show"]`)[0]
				$(checkbox).removeAttr('checked')
			})

			$('.fa-eye-slash').click(function () {
				$(`.fa-eye`).addClass('visible')
				$(this).removeClass('visible')
				let checkbox = $(`input[value="show"]`)[0]
				$(checkbox).attr('checked', '')
			})
			break

		case 'travelsBack':
			break

		case 'test':
			const openPhotoPicker = document.getElementById('openPhotoPicker')
			const closePhotoPicker = document.getElementById('closePhotoPicker')
			break
	}
})
