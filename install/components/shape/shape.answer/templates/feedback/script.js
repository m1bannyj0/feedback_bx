
console.log('..init');

BX.namespace('BX.Lc.Main');
            
$(function() {
        var hnm = $(".c-text-name > .c-editor > input"),
            hph = $(".c-text-phone > .c-editor > input"),
            hem = $(".c-text-email > .c-editor > input"),
			hcl = $(".c-text-color > .c-editor > #c-3-3"),
			htx = $(".c-text-msg > .c-editor > #c-4-2"),
			oag = $(".c-agree > #n2_69"),
			osb = $("#c-submit-button"),
			ofr = $("#c-forms"),
			obd=$(".c-forms-form-body"),
			ajaxPath = '/bitrix/components/shape/shape.answer/ajax.php',
            i, n, answer , checkall=0,
            debug=false;
			
			BX.Lc.Main = {
            initExist: function () {
                console.log('..preset:',i.isEmpty($("#c-forms")));
            }};
    

            console.log('..next');
			
    
			$('.c-button-section').on('mouseover', function(e){
				debug&&(console.log('..inspect'))
				requredls=window.ShapeReqFields;
                var sO=Object.keys(requredls);
                Object.keys(requredls).forEach((value,index)=>!i.isEmpty(requredls[value])&&checkall++);
                if (sO.length===checkall) {
                    debug&&console.log('..complete message',sO.length,checkall);
                } else {
                    debug&&console.log('..not complete message',sO.length,checkall);
                    for (var key in requredls) {
                    !i.isEmpty(requredls[key])&&!$("."+key).find(".c-editor > input").val()&&n.invalidStyle($("."+key))
                    } 
                }			
			});
			
			
       
            ofr.on('submit', function(e){
                e.preventDefault();

				
				var ajaxArr = {
                        query  : typeof query!='undefined'?query:'empty_query',
                        page   : location.href,
                        action : "writeform",
                        sessid : BX.bitrix_sessid(),
                        site_id: BX.message('SITE_ID'),
						data: ofr.serializeArray()
                    };

                    $.post(ajaxPath, ajaxArr, function(answer){
                        debug&&console.log('answer',answer);
                        window.answer=answer;
						if (typeof answer['errors']!='undefined')
						{
							for (it in answer['errors']) {
								console.log($(".c-text-"+answer['errors'][it]).find(".c-editor > input").val());
								n.invalidStyle($(".c-text-"+answer['errors'][it]),'Неверный формат');
							} 	
						}
						if (!$(".c-error").length&&answer['success'])
						{
							obd.hide().parent().append('<h1>complete</h1>');
						}

                        if (typeof callback !== 'undefined'){
                            callback(answer);
                        }
                    }, "json");
				
             });


        
        i = {
            passwordReveal: function(n) {
                n.checked ? $(n.parentElement.previousElementSibling).attr("type",
                    "text") : $(n.parentElement.previousElementSibling).attr("type",
                    "password")
            },
            checkEmail: function() {
                o[0].checked = !0;
                t.val() !== "" && n.checkLogin()
            },
            checkPhone: function() {
                p.val() !== "+7(___)___-__-__" && n.checkPhone()

            },
            isEmpty: function(s) {
                return (!s || 0 === s.length)
            }
        };
        
        n = {
            error: $(".error"),
            check: function(t) {
                var t = $(t);
                t.attr("id") === "login" && n.checkLogin(t);
            },validStyle: function(t) {
                // n.setStyle(t, "valid");
                n.removeClass("c-error");
				t.find(".c-validation").html('Обязательное..')
                n.checkItems()
            },
            invalidStyle: function(t, i='') {
                n.setStyle(t, "c-error");
				i&&t.find(".c-validation").html(i)
            },
            setStyle: function(n, t) {
                n = $(n);
                n.removeClass("valid invalid");
                n.addClass(t)
            }

        };
        
        $(".c-text-phone > .c-editor > input").mask('+70000000000', {placeholder: "+7(___)___ __ __"});    

})();   

