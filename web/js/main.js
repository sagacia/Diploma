
//jQuery(document).ready(function($) {
//    alert('main');
//});

/**/
$('.watsonsdownload').on('click', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var res = $('.downloadResult');
    var inputurl = $('.inputurl').val();
    console.log(inputurl);
   // return;
    
    $.ajax({
        type: "GET",
        url: url,
        //data: {"id": id},
        //cache: false,
        timeout: 216000,
        data: {"inputurl": inputurl},
        success: function (response) {
            //res.append("<p>response</p>");
            res.append(response);
          //  console.log(response);
        },
        error: function (jqXHR, status, e) {
            //alert('error!');
            if (status === "timeout") {
                alert("Время ожидания ответа истекло!");
            }
            console.log('ошибка ');
        }
    });

});

/* сопоставление товаров по клику === делегируем, так как wproduct динамический и его нет на первоначальной странице */
$('.wname').on('click', '.wproduct', function (e) {

    e.preventDefault();

    var wproductname = $(this).find('a').text(); //имя продукта
    var wproductid = $(this).find('a').attr('wproductid'); //получаем id
    var id = $(this).parents('.productrow').find('.productid').text();
    var input = $(this).parents('.productrow').find('input').val(wproductname); //записываем новое имя
    var input = $(this).parents('.productrow').find('.prename').text(wproductname); //записываем новое имя

    var url = $(this).parents('.productrow').find('input').attr('url');
    var price = $(this).parents('.productrow').find('.wprice'); //получаем поле, где будет отображена цена
    price.text('обновляется');


    //var input = $(this).parent().parent().parent().find('input').val(wproductname);

    //return;
    $.ajax({
        type: "GET",
        url: url,
        data: {"id": id, wid: wproductid},
        //cache: false,
        success: function (response) {
            price.text(response);
        },
        error: function () {
            //alert('error!');
            console.log('ошибка ' + search);
        }
    });
    $('.wresSearch').text('');






});


/* включение/отключение редактирования для сопоставления товаров*/
$('.change-wproduct').on('click', function (e) {
    e.preventDefault();
    var att = $(this).parent().find('input').attr('readonly');
    if ($(this).parent().find('input').attr('readonly') == 'readonly')
    {
        $(this).find('.glyphicon').addClass('glyphicon-ok').removeClass('glyphicon-pencil');
        $(this).parent().find('input').attr('readonly', false);
        $(this).parent().find('input').css('visibility', 'visible');
        $(this).parent().find('.prename').css('visibility', 'hidden');
        $(this).parent().find('input').select();

    } else {
        $(this).parent().find('.glyphicon').addClass('glyphicon-pencil').removeClass('glyphicon-ok');
        $(this).parent().find('input').attr('readonly', true);
        $(this).parent().find('input').css('visibility', 'hidden');
        $(this).parent().find('.prename').css('visibility', 'visible');
    }
});

/*Живой поиск товаров конкурента watsons*/
$(".wsearch").keyup(function () {
    var search = $(this).val(); //получаем значение в строке поиска
    var res = $(this).parent().find('.wresSearch'); //находим необходимый div для результатов поиска
    if (search.length > 1)
    {

        $.ajax({
            type: "GET",
            url: "/admin/catman/live-search",
            data: {"wsearch": search},
            cache: false,
            success: function (response) {
                $(res).html(response);
            },
            error: function () {
                //alert('error!');
                console.log('ошибка ' + search);
            }
        });
    } else {
        //$('.wresSearch').css("z-index", "-1");
    }
    return false;

});
//jQuery(document).ready(function ($) {
//    $(function () {
//        $(".wsearch").focus(function () {
//            //  var search = $(this).val(); //получаем значение в строке поиска
//            var res = $(this).parent().find('.wresSearch'); //находим необходимый div для результатов поиска
//            // $(document).find('.wresSearch').html('');
//            res.css("z-index", "3000");
//
//        });
//    });
//});
/*Живой поиск товаров конкурентов*/


/*Удаление всех товаров*/
$(function () {
    $('.productsDel').on('click', function (e) {
        e.preventDefault();
        var conf = confirm("Вы действительно хотите удалить все товары?");
        if (conf) {
            $.ajax({
                url: '/admin/default/productsdel',
                type: "GET",
                success: function (res) {
                    if (res) {
                        window.location.href = '/admin/product/index';
                    }
                },
                error: function () {
                    console.log("error ajax");
                }
            });
        }
    });
});
/*Удаление всех товаров*/




/*Загрузка данных из файлов (категории, бренды, товары)*/

$(function () {

    $('#my_form').on('submit', function (e) {
        e.preventDefault();
        var $that = $(this),
                formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму

        if ($("input[name='myfile[]'")[0].value.length > 0) {
            $('.ajax-respond').css("visibility", "visible");
            $('.ajax-respond').html("Идет загрузка");
        } else {
            $('.ajax-respond').css("visibility", "visible");
            $('.ajax-respond').append("Выберите файл");
            return;
        }

        $.ajax({
            url: $that.attr('action'),
            type: $that.attr('method'),
            contentType: false, // убираем форматирование данных по умолчанию
            processData: false, // убираем преобразование строк по умолчанию
            data: formData,
            //dataType: 'json',
            success: function (json) {
                if (json) {
                    //$('.ajax-respond').replaceWith(json);
                    //$('.ajax-respond').html(json);
                    $('.ajax-respond').css("visibility", "visible");
                    //$('.ajax-respond').append(json);
                    console.log(json);
                }
            },
            error: function () {
                console.log("error ajax");
            }
        });
    });
});
/*Загрузка данных из файлов (категории, бренды, товары)* -------/
 
 
 
 
 /*Живой поиск товара*/
jQuery(document).ready(function ($) {
    $(function () {
        $("#search").keyup(function () {
            var search = $("#search").val();
            if (search.length > 2)
            {
                console.log('search good');
                $('#resSearch').css("z-index", "3000");
                $.ajax({
                    type: "GET",
                    url: "/category/live-search",
                    data: {"search": search},
                    cache: false,
                    success: function (response) {
                        $("#resSearch").html(response);
                        //$("#resSearch").html('fffff');
                    },
                    error: function () {
                        console.log('ошибка ' + search);
                    }
                });
            } else {
                $('#resSearch').css("z-index", "-1");
            }
            return false;
        });
    });
});



/*показать корзину - модальное окно*/
function showCartModal(cart) {
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
}
/* Очистить корзину */
function clearCart() {
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function (res) {
            if (!res)
                alert('Ошибка');
            showCartModal(res);
        },
        error: function () {
            alert('error!');
        }
    });
}


/* показать корзину в модальном окне */
function getCartModal() {
    $.ajax({
        url: '/cart/getcartmodal',
        type: 'GET',
        success: function (res) {
            if (!res)
                alert('Ошибка');
            showCartModal(res);
        },
        error: function () {
            alert('error!');
        }
    });
}
/*добавление в корзину и показ модального окна с корзиной */
$('.add-to-cart').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var qty = $('#qty').val();
    $.ajax({
        url: '/cart/add',
        data: {id: id, qty: qty},
        type: 'GET',
        success: function (res) {
            if (!res)
                alert('Ошибка');
            showCartModal(res);
            console.log(qty);

        },
        error: function () {
            alert('error!');
        }
    });
});


/* удаление элемента из корзины 
 * корзина формируется динамически, поэтому делегируем события - для модального окна */
$('#cart .modal-body').on('click', '.del-item-modal', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/del-item-modal',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res)
                alert('Ошибка');
            showCartModal(res);
        },
        error: function () {
            alert('error!');
        }
    });
});

/* включаем аккордеон для элемента */
jQuery(document).ready(function ($) {
    jQuery('#accordion').dcAccordion();
});



/*
 HW Slider - простой слайдер на jQuery. 
 
 Настройки скрипта:
 
 hwSlideSpeed - Скорость анимации перехода слайда.
 hwTimeOut - время до автоматического перелистывания слайдов.
 hwNeedLinks - включает или отключает показ ссылок "следующий - предыдущий". Значения true или false
 */
(function ($) {
    var hwSlideSpeed = 1000;
    var hwTimeOut = 3000;
    var hwNeedLinks = true;

    $(document).ready(function (e) {
        $('.slide').css(
                {/*"position" : "absolute",*/
                    "top": '0', "left": '0'}).hide().eq(0).show();
        var slideNum = 0;
        var slideTime;
        slideCount = $("#slider .slide").size();
        var animSlide = function (arrow) {
            clearTimeout(slideTime);
            $('.slide').eq(slideNum).fadeOut(hwSlideSpeed);
            if (arrow == "next") {
                if (slideNum == (slideCount - 1)) {
                    slideNum = 0;
                } else {
                    slideNum++
                }
            } else if (arrow == "prew")
            {
                if (slideNum == 0) {
                    slideNum = slideCount - 1;
                } else {
                    slideNum -= 1
                }
            } else {
                slideNum = arrow;
            }
            $('.slide').eq(slideNum).fadeIn(hwSlideSpeed, rotator);
            $(".control-slide.active").removeClass("active");
            $('.control-slide').eq(slideNum).addClass('active');
        }
        if (hwNeedLinks) {
            var $linkArrow = $('<a id="prewbutton" href="#">&lt;</a><a id="nextbutton" href="#">&gt;</a>')
                    .prependTo('#slider');
            $('#nextbutton').click(function () {
                animSlide("next");
                return false;
            })
            $('#prewbutton').click(function () {
                animSlide("prew");
                return false;
            })
        }
        var $adderSpan = '';
        $('.slide').each(function (index) {
            $adderSpan += '<span class = "control-slide">' + index + '</span>';
        });
        $('<div class ="sli-links">' + $adderSpan + '</div>').appendTo('#slider-wrap');
        $(".control-slide:first").addClass("active");
        $('.control-slide').click(function () {
            var goToNum = parseFloat($(this).text());
            animSlide(goToNum);
        });
        var pause = false;
        var rotator = function () {
            if (!pause) {
                slideTime = setTimeout(function () {
                    animSlide('next')
                }, hwTimeOut);
            }
        }
        $('#slider-wrap').hover(
                function () {
                    clearTimeout(slideTime);
                    pause = true;
                },
                function () {
                    pause = false;
                    rotator();
                });
        rotator();
    });
})(jQuery);



