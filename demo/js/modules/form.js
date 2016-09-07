materialAdmin 

    // =========================================================================
    // INPUT FEILDS MODIFICATION
    // =========================================================================

    //Add blue animated border and remove with condition when focus and blur

    .directive('fgLine', function(){
        return {
            restrict: 'C',
            link: function(scope, element) {
                if($('.fg-line')[0]) {
                    $('body').on('focus', '.form-control', function(){
                        $(this).closest('.fg-line').addClass('fg-toggled');
                    })

                    $('body').on('blur', '.form-control', function(){
                        var p = $(this).closest('.form-group');
                        var i = p.find('.form-control').val();

                        if (p.hasClass('fg-float')) {
                            if (i.length == 0) {
                                $(this).closest('.fg-line').removeClass('fg-toggled');
                            }
                        }
                        else {
                            $(this).closest('.fg-line').removeClass('fg-toggled');
                        }
                    });
                }
    
            }
        }
        
    })

    

    // =========================================================================
    // AUTO SIZE TEXTAREA
    // =========================================================================
    
    .directive('autoSize', function(){
        return {
            restrict: 'A',
            link: function(scope, element){
                if (element[0]) {
                   autosize(element);
                }
            }
        }
    })
    

    // =========================================================================
    // BOOTSTRAP SELECT
    // =========================================================================

    .directive('selectPicker', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                //if (element[0]) {
                    element.selectpicker();
                //}
            }
        }
    })
    


    // =========================================================================
    // CHOSEN
    // =========================================================================
    
    .directive('tagSelect', function(){
        return {
            restrict: 'A',
            terminal:true,
            link: function(scope, element, attrs) {
                if(attrs.placeBox != null && scope.chosen_place != null){
                    if (element[0]) {
                        scope.chosen_place[attrs.id] = (element.chosen({
                            width: '100%',
                            allow_single_deselect: true
                        }))
                    }    
                } else {
                    element.chosen({
                        width: '100%',
                        allow_single_deselect: true
                    });
                }
                
            }
        }
    })



    // =========================================================================
    // INPUT MASK
    // =========================================================================

    .directive('inputMask', function(){
        return {
            restrict: 'A',
            scope: {
              inputMask: '='
            },
            link: function(scope, element){
                element.mask(scope.inputMask.mask);
            }
        }
    })


    
    // =========================================================================
    // NO UI SLIDER 
    // =========================================================================

    //Basic

    .directive('inputSlider', function(){
        return {
            restrict: 'C',
            link: function(scope, element, attrs) {
                var isStart = attrs.isStart;
                
                element.noUiSlider({
                    start: isStart,
                    range: {
                        'min': 0,
                        'max': 100,
                    }
                });
            }
        }
    })

    //Range

    .directive('inputSliderRange', function(){
        return {
            restrict: 'C',
            link: function(scope, element, attrs) {                
                element.noUiSlider({
                    start: [30, 60],
                    range: {
                        'min': 0,
                        'max': 100
                    },
                    connect: true
                });
            }
        }
    })
    
    //Values

    .directive('inputSliderValuesOld', function(){
        return {
            restrict: 'C',
            link: function(scope, element, attrs) {
                element.noUiSlider({
                    start: [ 1000, 200000 ],
                    connect: true,
                    direction: 'ltr',
                    behaviour: 'tap-drag',
                    range: {
                        'min': 1000,
                        'max': 200000
                    },
                    format: wNumb({
                        decimals: 0,
                        thousand: '.',
                        postfix: ' Pesos',
                    })
                })

                $('.input-slider-values').Link('lower').to($('#value-lower'));
                $('.input-slider-values').Link('upper').to($('#value-upper'), 'html');
                
            }
        }
    })


    .directive('inputSliderValuesTp', function(){
        return {
            restrict: 'C',
            link: function(scope, element, attrs) {
                element.noUiSlider({
                    start: [ 0, 10000 ],
                    connect: true,
                    direction: 'ltr',
                    behaviour: 'tap-drag',
                    range: {
                        'min': 0,
                        'max': 10000
                    }
                });

                $('.input-slider-values-tp').Link('lower').to($('#value-lower'));
                $('.input-slider-values-tp').Link('upper').to($('#value-upper'), 'html');
                
            }
        }
    })


    
    // =========================================================================
    // DATE TIME PICKER
    // =========================================================================

    .directive('dtPicker', function(){
        return {
            require : '?ngModel',
            restrict: 'A',
            scope: {
                viewMode: '@',
                format: '@'
            },
            link: function(scope, element, attrs, ngModel){
                if(attrs.inline == "true"){
                    element.datetimepicker({
                        inline:true,
                        viewMode: scope.viewMode,
                        format: 'YYYY-MM-DD',
                        minDate:new Date()

                    })
                    .on('dp.change', function (e) {
                        ngModel.$setViewValue(new Date($(element).val()));
                    });
                } else {
                    if($(element).attr('data-format') == "hh:mm"){
                        element.datetimepicker({
                            viewMode: scope.viewMode,
                            format: scope.format,
                        })
                        .on('dp.change', function (e) {
                            ngModel.$setViewValue($(element).val());
                        });
                    } else {
                        if(element.attr('minDate')!=null){
                            element.datetimepicker({
                                viewMode: scope.viewMode,
                                format: scope.format,
                                minDate:new Date()
                            })
                            .on('dp.change', function (e) {
                                ngModel.$setViewValue($(element).val());
                                var array_date = $(element).val().split('/');

                                if(array_date.length == 3){
                                    if(element.attr('data-linked-major-dt')){
                                        var max_date = new Date(array_date[2] + '-' + array_date[1] + '-' + array_date[0]);
                                        max_date.setDate(max_date.getDate() + 2);
                                        var linkedMajorDt = $("[data-ng-model='" + element.attr('data-linked-major-dt') +"']"); 
                                        if(linkedMajorDt){
                                            linkedMajorDt.data("DateTimePicker").minDate(max_date)
                                        }                          
                                    }
                                }   
                            });
                        }
                        else {
                            element.datetimepicker({
                                viewMode: scope.viewMode,
                                format: scope.format,
                            })
                            .on('dp.change', function (e) {
                                ngModel.$setViewValue($(element).val());
                            });
                        }
                    }                    
                }
            }
        }
    })


    
    // =========================================================================
    // COLOR PICKER
    // =========================================================================

    .directive('colorPicker', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                $(element).each(function(){
                    var colorOutput = $(this).closest('.cp-container').find('.cp-value');
                    $(this).farbtastic(colorOutput);
                });
                
            }
        }
    })


    
    // =========================================================================
    // SUMMERNOTE HTML EDITOR
    // =========================================================================

    //Basic

    .directive('htmlEditor', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                element.summernote({
                    height: 150
                });
            }
            
        }
    })

    //Edit and Save

    .directive('hecButton', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                element.on('click', function(){
                    $('.hec-click').summernote({
                        focus: true
                    })
                    
                    $('.hec-save').show();
                })
                
                $('.hec-save').on('click', function(){
                    $('.hec-click').destroy();
                    $('.hec-save').hide();
                })
            }
        }
    })

    //Air Mode

    .directive('hecAirmod', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                element.summernote({
                    airMode: true
                })
            }
        }
    })



    // =========================================================================
    // PLACEHOLDER FOR IE 9 (on .form-control class)
    // =========================================================================

    .directive('formControl', function(){
        return {
            restrict: 'C',
            link: function(scope, element, attrs) {
                if(angular.element('html').hasClass('ie9')) {
                    $('input, textarea').placeholder({
                        customClass: 'ie9-placeholder'
                    });
                }
            }
            
        }
    })
