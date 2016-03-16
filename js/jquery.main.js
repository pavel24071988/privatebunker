var URL = (document.location.pathname).split('/');
$(document).ready(function() {
    var windowH = $(window).height();
    $('.screen').css('height', windowH );
    // инициализируем тексты и интервал
    var textsObj = {},
	showSpellTextInterval,
        setShowTimeOut;
    $('.scheme-content .scheme-content-item').each(function(){
		var $this = $( this );
		var curClass = $this.attr('class').replace('scheme-content-item', '').trim();
		textsObj[curClass] = $this.text().trim();
    });
    $('.scheme-categories-item').on('click', function(){
	clearInterval(showSpellTextInterval);
	var $this = $( this );
        var curid = $this.attr('data-id');
	var $curtext = $('.'+ curid),
	    $curTextLast = $('.scheme-content .'+ curid);
	var curtext = textsObj[curid];
    	$('.scheme-categories-item').removeClass('focused');
    	$this.addClass('focused');
	$('.scheme-content-item, .scheme-block-images-item, .scheme-content-default').hide();
	$curtext.show().text('');
	var signsCounter = 0;
	showSpellTextInterval = setInterval(function(){
		signsCounter++;
		$curTextLast.text((curtext.slice(0, signsCounter)));	
	}, 30);
	return false;
    });
    $(document).on('click', function(event){
		var $this = $( event.target );
		if($this.closest('.scheme-categories').length === 0 && $this.closest('.scheme-content').length === 0){
			clearInterval(showSpellTextInterval);
			$('.scheme-block-images-item, .scheme-content-item').hide();
			$('.scheme-block-images-item:first, .scheme-content-default').show();
			$('.scheme-categories-item').removeClass('semi-visible').removeClass('focused');
		};
    });
    
    $('.scheme-categories-item').on('mouseover', function(event){
        clearTimeout(setShowTimeOut);
        $( this ).trigger('click');
    });
    
    $('.scheme-categories-item').on('mouseout', function(event){
        clearTimeout(setShowTimeOut);
        setShowTimeOut = setTimeout(function(){
            $(document).trigger('click');
        }, 300);
    });
    // начинаем прописывать логику )) нижней формы контакты
    $('.contacts-form button[type="submit"]').on('click', function(){
        $.ajax({
            type: 'POST',
            url: '/ajax.php/contacts',
            data: { method: 'contacts', data: $('.contacts-form').serialize() }
        }).done(function(response){
           $('.contactsMessage').remove();
           $('.contacts-form fieldset').after('<div style="color: white; display: none;" class="contactsMessage">'+ JSON.parse(response).response +'</div>');
           $('.contactsMessage').fadeIn(400);
        });
        return false;
    });
    //
    $('.top-navigation .about_menu').on('click', function(){
    	var about = $('#about').position().top;
    	$('html,body').stop().animate({scrollTop: about}, 1000);
    	return false;
    });
    $('.top-navigation .protection_menu').on('click', function(){
    	var protection = $('#protection').position().top;
    	$('html,body').stop().animate({scrollTop: protection}, 1000);
    	return false;
    });
    $('.top-navigation .alerts_menu').on('click', function(){
    	var alerts = $('#alerts').position().top + 10;
    	$('html,body').stop().animate({scrollTop: alerts}, 1000);
    	return false;
    });
    $('#scroll-bottom').on('click', function(){
    	var btm = $(document).height();
    	$('html,body').stop().animate({scrollTop: btm}, 1000);
    	return false;
    });
});
//
$(document).scroll(function() {
	var scr = $(document).scrollTop(),
            wH = $(window).height(),
            aboutH = $('.about').outerHeight(),
            schemeH = $('.scheme-block').outerHeight(),
            alertsH = $('.alerts').outerHeight(),
            thrts = $('.threats').height(),
            srvc = $('.services').height(),
            cnts = $('.contacts-map').height();
	if (scr > 250) {$('.private-bunker').addClass('fixed');}
        else {$('.private-bunker').removeClass('fixed');}
	//
	if (scr > wH-32) {$('.top-navigation').addClass('black');}
	else {$('.top-navigation').removeClass('black');}
	//
	if (scr > (wH+aboutH)-32) {$('.top-navigation').removeClass('black');}
	//
	if (scr > (wH+aboutH+schemeH)) {$('.top-navigation').addClass('black');}
	//
	if($(window).scrollTop()+$(window).height()>=($(document).height())){
            $('.top-navigation').removeClass('black');
	}
        if($(window).scrollTop()+$(window).height()>=($(document).height() - 1000)){
            $('.grid').addClass('visible');
            $('.contacts-list').delay(1000).fadeIn(600);
            $('.contacts-logo').delay(500).fadeIn(300).delay(600).addClass('twist');
            $('.contacts-form').delay(700).fadeIn(400);
	}
	//
	if ($(window).scrollTop()<=thrts) {$('.top-navigation').addClass('black');}
	//
	if ($(window).scrollTop()<=srvc) {$('.top-navigation').addClass('black');}
        //
	if ($(window).scrollTop()<=cnts && URL[1] !== 'services' && URL[1] !== 'threats') {$('.top-navigation').removeClass('black');}
});
