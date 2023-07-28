<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap-5.1.3-dist/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/faq/faq.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    {{-- HEADER --}}
    <div class="container container-faqs mt-5">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-12 wrapper-top-faqs">
                <div class="wrapper-faqs">
                    <p class="title-faqs">Các câu hỏi thường gặp</p>
                    <p class="description-faqs">
                        Nếu bạn không tìm thấy câu hỏi thường gặp, bạn có thể liên hệ với chúng tôi. Chúng tôi
                        sẽ trả lời bạn trong thời gian ngắn nhất
                    </p>
                </div>
            </div>
        </div>

        <div class="row" style="margin-bottom: 40px">
            <div class="col-12 wrapper-search-faqs">
                <div class="form-input from-faq-search">
                    <span class="icon"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" id="search" class="form-input" placeholder="Tìm kiếm">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="wrapper-tabs-faqs">
                    <div class="tabs-faqs-list">
                        @foreach ($tabs as $tab)
                        <div class="tab-faq-item {{$tab['type'] === 1 ? 'active' : ''}}"
                            data-type-tab="{{$tab['type']}}">
                            <span class="tab-faq-topic">{{$tab['topic']}}</span>
                        </div>
                        @endforeach
                        <div class="line-faqs"></div>
                    </div>
                    <div class="accordion">
                        @foreach ($faqs as $faq)
                        <div class="accordion-faq-content" data-type-content='{{$faq->type}}'>
                            <header>
                                <span class="accordion-faq-title">{{$faq->title}}</span>
                                <i class="fas fa-plus"></i>
                            </header>

                            <p class="accordion-faq-description">
                                {!! nl2br($faq->description) !!}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row search-not-found">
            <div class="col-12">
                <p class="search-not-found-title">Không tìm thấy câu trả lời tương ứng</p>
            </div>
        </div>
    </div>
    {{-- FOOTER --}}
</body>

<script type="text/javascript">
    $('.accordion-faq-content').each(function(index, item) {
        const header = $(item).find('header');
        header.on('click', () => {
            $(item).toggleClass('open');
            const description = $(item).find('.accordion-faq-description');
            const icon = $(item).find('header i');
            if($(item).hasClass('open')){
                description.height(description.prop('scrollHeight'));
                icon.removeClass("fa-plus").addClass("fa-minus");
            }
            else {
                description.height(0);
                icon.removeClass("fa-minus").addClass("fa-plus");
            }
            removeOpen(index);
        });
    });

    function removeOpen(indexOpen) {
        $('.accordion-faq-content').each(function(index, item) {
            if(index !== indexOpen){
                $(item).removeClass("open");
                const description = $(item).find('.accordion-faq-description');
                const icon = $(item).find('header i');
                description.height(0);
                icon.removeClass("fa-minus").addClass("fa-plus");
            }
        })
    };

    (function activeTab(){
        let leftOfItem = $('.active').prop('offsetLeft');
        let widthOfItem = $('.active').outerWidth();
        $('.line-faqs').css({'left': leftOfItem + "px", 'width': widthOfItem + "px"});

        const dataTypeTab = $('.active').attr('data-type-tab');

        $('.accordion-faq-content').each(function(index, item) {
            const dataTypeContent = $(item).attr('data-type-content');
            if(dataTypeContent === dataTypeTab) {
                $(item).css({'display': 'block'});
            }
            else {
                $(item).css({'display': 'none'});
            }
        });
    })();

    $('.tab-faq-item').each(function(index, item) {
        $(item).on('click', () => {
            $('#search').val('');
            $('.search-not-found').css({'display': 'none'});
            $('.active').removeClass('active');
            let leftOfItem = $(item).prop('offsetLeft');
            let widthOfItem = $(item).outerWidth();
            $('.line-faqs').css({'left': leftOfItem + "px", 'width': widthOfItem + "px"});
            $(item).addClass('active');

            let dataTypeTab = $(item).attr('data-type-tab');

            $('.accordion-faq-content').each(function(index, item) {
            const dataTypeContent = $(item).attr('data-type-content');
            if(dataTypeContent === dataTypeTab) {
                $(item).css({'display': 'block'});
            }
            else {
                $(item).css({'display': 'none'});
            }
            });
        });

    });

    $('#search').change((e) => {
        const value = $('#search').val().trim().toLowerCase();
        let isHaveResult = false;
        if(value){
            $('.active').removeClass('active');
            $('.line-faqs').css({'left': 0 + "px", 'width': 0 + "px"});
            $('.accordion-faq-title').each(function(index, item) {
                let text = $(item).text().trim().toLowerCase();
                let parent = $(item).closest('.accordion-faq-content');
                if(text.indexOf(value) !== -1){
                    $('.search-not-found').css({'display': 'none'});
                    isHaveResult = true;
                    parent.css({'display': 'block'});
                }
                else {
                    parent.css({'display': 'none'});
                }
            });
        }
        if(!isHaveResult){
            $('.search-not-found').css({'display': 'block'});
        }
    });
</script>

</html>
