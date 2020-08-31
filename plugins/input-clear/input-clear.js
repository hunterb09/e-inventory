function inputClear(ele){
    var T = this;
    this.container = $('.'+ele);  
    this.inputEle = this.container.find('input');   
    this.deleteEle = this.inputEle.next(); 

    this.init();
}

inputClear.prototype.init = function(){
    var T = this;

    (function(){
        if(navigator.appName == 'Microsoft Internet Explorer'){
            if(navigator.appVersion.match(/9./i) == '9.'){
                T.inputEle.keyup(function(event){
                    if(event.keyCode == 8){
                        ($(this).val() == '') ? $(this).next().fadeOut(100) : $(this).next().fadeIn(100);
                    }
                });
            }
        }

        T.inputEle.on('blur',function(){
            $(this).next().fadeOut(300);
        }).on('focus',function(){
            ($(this).val() == '') ? $(this).next().fadeOut(100) : $(this).next().fadeIn(100); 
        }).on('input propertychange',function(){
            ;($(this).val() == '') ? $(this).next().fadeOut(100) : $(this).next().fadeIn(100);
        });

        T.deleteEle.on('click',function(){
            $(this).hide().prev().val('');
        });

    })();
}
