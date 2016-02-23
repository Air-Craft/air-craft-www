
jQuery(function ($) {
    "use strict";
    
    // VIDEO LIGHTBOX
    console.log("VIDEO LIGHTBOX");
    console.log($("a.colorbox"));
    $("a.colorbox").colorbox({iframe:true, width:"95%", height:"95%"});
    
    
    // JUST FOR LAUNCH NOW
    if (document.body.className.indexOf('page-template-launch') == -1) {
    	return;
    }
    console.log("JSing LAUNCH template...");
    
    
    // $("a.flare").peFlareLightbox();
    
    
    // // Link up the play button to the video on mobile
	// $(window)[0].onYouTubeIframeAPIReady = linkUpVideoButtons;
//     	
// 		
	// function linkUpVideoButtons()
	// {
		// var player = new YT.Player("background-video", {
            // events: {
                // 'onReady': function () {
			       // // player.mute();
			       // // player.playVideo();
                // },
                // // loop, since the QS var doesnt work
                // 'onStateChange' : function(e){
                    // if (e.data == 0){
                        // player.seekTo(0);
                    // }
                // }
            // }
        // });
//         
        // // MUTE
    	// var muteBtn = $('#video-mute-btn');
		// muteBtn.on('click', function() {
			// if (player.isMuted()) {
				// console.log('Unmuting');
				// player.unMute();
				// muteBtn.find('i').removeClass('fa-volume-off').addClass('fa-volume-up');
			// } else {
				// console.log('Muting');
				// player.mute();
				// muteBtn.find('i').removeClass('fa-volume-up').addClass('fa-volume-off');
			// }
		// });
// 	     
     	// // PLAY
 		// var playBtn = $('#video-play-btn');
 		// playBtn.on('click', function () {
 			// // console.log('Play video');
 			// // alert(player.getPlayerState());
 			// // player.playVideo();
 			// // alert(player.getPlayerState());
		// });	                  
    // }
});
