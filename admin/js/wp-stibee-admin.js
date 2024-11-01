(function( $ ) {
	'use strict';

	$(document).ready(function () {
		var spectrumOptions = {
			showInput: true,
			showInitial: true,
			togglePaletteOnly: false,
			togglePaletteMoreText: '더보기',
			togglePaletteLessText: '닫기',
			showSelectionPalette: true,
			chooseText: '확인',
			cancelText: '취소',
			preferredFormat: 'hex',
			clickoutFiresChange: false,
			maxSelectionSize: 16,
			showAlpha: false
		}

		$("#Wp_Stibee_buttoncolor").spectrum(spectrumOptions);
		$("#Wp_Stibee_buttonbg").spectrum(spectrumOptions);

		
		if(location.search.indexOf('tab=lists') !== -1) {
			$('.toplevel_page_wp-stibee .wp-submenu li').removeClass('current');
			$('.toplevel_page_wp-stibee .wp-submenu li:nth-child(3)').addClass('current');
		}

		if(location.search.indexOf('tab=style') !== -1) {
			$('.toplevel_page_wp-stibee .wp-submenu li').removeClass('current');
			$('.toplevel_page_wp-stibee .wp-submenu li:nth-child(4)').addClass('current');
		}

		$('#wp-stibee-api-remove-button').click(function () {
			var conf = confirm('정말 삭제하시겠습니까?');
			if (conf == true) {
				$('#Wp_Stibee_apitoken').val('');
			}
		});
	});

})( jQuery );
