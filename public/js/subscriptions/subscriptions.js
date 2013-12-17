/**
 * Created by student on 12/17/13.
 */
(function($){
    $(document).ready(function(){
        $('.unsub').on('click',function(e){
            e.preventDefault();
            $.ajax({
                url : 'http://10.11.80.15/php-education-project/public/subscriptions/Subscriptions/unsubscribeFromUser',
                type : 'POST',
                data : {'targetId' : $(this).data('id')}
            });
        });
    });
})(jQuery);