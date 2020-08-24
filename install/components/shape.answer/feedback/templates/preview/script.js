console.log('..init fback');
$(function() {
        var hnm = $(".c-name > .c-editor > input"),
            hph = $(".c-text-phone > .c-editor > input"),
            hem = $(".c-text-email > .c-editor > input"),
			hcl = $(".c-choice-dropdown > .c-editor > #c-3-3"),
			htx = $(".c-text-message > .c-editor > #c-4-2"),
			oag = $(".c-agree > #n2_69"),
			osb = $("#c-submit-button"),
			ofr = $("#c-forms"),
			SAnswer = new ShapeAnswer,
            i, n, answer , checkall=0
            debug=true;
    
            answer= (answer!==undefined)?answer:{
            "c-phone":'',
            "c-name":'1',
            "c-text-email":'',
            "c-text-message":'',
            "c-agree":''
            }
    


        
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
                // p.val() !== "+7(___)___-__-__" && n.checkPhone()

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
                // n.error.hide();
                n.checkItems()
            },
            invalidStyle: function(t, i='') {
                n.setStyle(t, "c-error");
                // i && n.error.text(i).show()
            },
            setStyle: function(n, t) {
                n = $(n);
                n.removeClass("valid invalid");
                n.addClass(t)
            }

        };
        
            var sO=Object.keys(answer);
            Object.keys(answer).forEach((value,index)=>!i.isEmpty(answer[value])&&checkall++);
            if (sO.length===checkall) {
                debug&&console.log('..complete message',sO.length,checkall);
                
            } else {
                debug&&console.log('..not complete message',sO.length,checkall);
                for (var key in answer) {
                i.isEmpty(answer[key])&&n.invalidStyle($("."+key))
                } 
            }

});    
