jQuery(function ($) {
    $(document).ready(function () {


        $('.operationCalculator').click(function(){
            let v = $(this).val();
            let isFirstChar= !$('.showResult').val().length ? true : false;
            let isOperation = $(this).hasClass("operation");
            let length= $('.showResult').val().length;
            let lastChar = $('.showResult').val()[length-1];
            let operations = ['+','-','*','/']
            if( !isOperation) {
                let total = $('.showResult').val($('.showResult').val() + v);
            }
            else if(!isFirstChar && !operations.includes(lastChar)){
                    let total = $('.showResult').val($('.showResult').val() + v);
            }


        });
        $('#clearCalc').click(function(){
            $('.showResult').val('');
        });
        $('#evaluate').click(function(){
            let operations = ['+','-','*','/']
            let length= $('.showResult').val().length;
            let lastChar = $('.showResult').val()[length-1];
            if(operations.includes(lastChar)){
                $('.showResult').val($('.showResult').val().substring(0, length - 1));
            }
            $('.showResult').val(eval($('.showResult').val()));

        });
    });
});
