export default class ImagePicker {
	constructor(overlay, imgs) {
		this.overlay = overlay
		this.imgs = imgs
		this.test = 10
	}

	openImgPicker() {
		console.log(this)
		console.log(this.imgs)
		console.log(this.overlay)
		this.imgs.removeClass('active')
		this.overlay.addClass('visible')
	}
	closeImgPicker() {
		$('#imgPickerOverlay').removeClass('visible')
	}
	chooseImg() {
		$('#imgPickerContent figure').removeClass('active')
		$(this).addClass('active')
	}
	confirmImg(imgPicker) {
		let imgPickerId = $(imgPicker)[0].id.slice(-1)
		let chosenImgId = $('#imgPickerContent figure.active').data('id')
		$('#imgPickerOverlay').removeClass('visible')
		fetch(`getImgSrc-id-${chosenImgId}`)
			.then((response) => {
				return response.json()
			})
			.then((src) => {
				document.getElementById(`src${imgPickerId}`).setAttribute('src', src)
				document
					.getElementById(`id${imgPickerId}`)
					.setAttribute('value', chosenImgId)
			})
	}
}
