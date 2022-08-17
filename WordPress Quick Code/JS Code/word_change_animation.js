var words = [
        'Confidently',
        'Affordably',
        'Smarter',
        'Better',
        'Faster'
    ],
    i = 0;

setInterval(function() {
    $('#ID_OF_TEXT').fadeOut(function() {
        $(this).html(words[i = (i + 1) % words.length]).fadeIn();
    });
}, 2000);