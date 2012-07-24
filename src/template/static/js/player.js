$(function() {	
	/**
	 * player-UI
	 */
		// picture
		$('#fm-picture').hover(function() {
			$('#fm-picture a').stop().show().fadeTo(220, 0.7)
	    }, function () {
			$('#fm-picture a').stop().fadeTo(200, 0)
		})
		// button pause,play
		$('#fm-pause').click(function() {
			$('#fm-play').show()
		})
		$('#fm-play').click(function() {
			$('#fm-play').hide()
		})
		// button volume
		$('.fm-status-mask').hover(function() {
			$('#fm-status span').stop().hide()
			$('.fm-status-volume-img').stop().animate({marginRight:'60px'}, 50, 'linear')
			$('.fm-status-volume').stop().show()
		}, function(event) {
			if ($(event.relatedTarget).attr('class') != 'fm-status-volume-bar') {
				$('.fm-status-volume').stop().hide()
				$('.fm-status-volume-img').stop().animate({marginRight:'0px'}, 'fast', 'linear')
				$('#fm-status span').stop().show()
			}
		})
		// switch opera
		$('#fm-opera').hover(function() {
			$('.fm-opera-switch').show(100)
		}, function() {
			$('.fm-opera-switch').hide()
		})
		// button repeat
		$('.fm-opera-repeat-default').click(function() {
			$(this).hide()
			$('.fm-opera-repeat-click').show()
		})
		$('.fm-opera-repeat-click').click(function() {
			$(this).hide()
			$('.fm-opera-repeat-default').show()
		})
	/**
	 * player-control
	 */
		var song = 'http://mr3.douban.com/201207241720/14b5c0b45f6119f96f7b91fddc2dd1c4/view/song/small/p1797426.mp3';
		$('#player').jPlayer({
			ready: function () {
				$(this).jPlayer('setMedia', {
					mp3: 'static/SunshineGirl.mp3'
					//mp3: song
				})
				//$(this).jPlayer('play')
			},
			solution: 'flash',
			swfPath: 'static/js/jplayer',
			errorAlerts: true,
			cssSelectorAncestor: '#player-con',
			cssSelector: {
				playBar: '.fm-progress-playbar',
				seekBar: '.fm-progress-seekbar',
				volumeBar: '.fm-status-volume-bar',
				volumeBarValue: '.fm-status-volume-value',
				currentTime: '#fm-status span[title=currentime]',
				repeat : '.fm-opera-repeat-default',
				repeatOff : '.fm-opera-repeat-click',
			},
		})
		$('#fm-pause').click(function() {
			$('#player').jPlayer('pause')
		})
		$('#fm-play').click(function() {
			$('#player').jPlayer('play')
		})
	})
