$ ->
    $('.map').each ->
        fit $('.banner', @)[0], @, {vAlign: fit.CENTER}

    fit $('footer')[0], $('html')[0], {vAlign: fit.BOTTOM}