$('document').ready(() => {
	// Click du modal supprimer
	$('.delete').on('click', function (event) {
		event.preventDefault()

		$('#confirm').on('click', () => {
			window.location = $(this).attr('href')
		})
	})

	function changeStatut() {
		$.get(`changeStatut-${$(this).data('action')}-${$(this).data('id')}`)
	}

	function createCookie() {
		$.get('cookieAccept')
		$('cookies').css('animation', '1s disappear forwards')
	}
	
	function addClass(){
		$('.panier').addClass('display');
		$('.backPanier').addClass('display');
	}
	// # EVENT LISTENERS
	$('#cart').on('click', addClass);
	
	$('.actions').on('click', 'a:first-child()', changeStatut)

	$('cookies').on('click', 'a', createCookie)
})
	$('.carouselItem img').on('click', function(){

	$('#actual').attr('src',$(this).attr('src'));
	
});