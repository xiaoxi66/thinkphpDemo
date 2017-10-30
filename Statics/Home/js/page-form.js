$().ready(function() {
            // 手机号码验证    
                jQuery.validator.addMethod("isPhone", function(value, element) {    
                var length = value.length;    
                return this.optional(element) || (length == 11 && /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(value));    
                }, "请正确填写您的手机号码。");
            // 匹配密码，以字母开头，长度在6-12之间，必须包含数字和特殊字符。
                jQuery.validator.addMethod("isPwd", function(value, element) {
                    var str = value;
                    if (str.length < 6 || str.length > 18)
                        return false;
                    if (!/^[a-zA-Z]/.test(str))
                        return false;
                    if (!/[0-9]/.test(str))
                        return fasle;
                    return this.optional(element) || /[^A-Za-z0-9]/.test(str);
                }, "以字母开头，长度在6-12之间，必须包含数字和特殊字符。");

        $("#signupform").validate({
            errorElement : 'span',
            errorClass : 'help-block',
            rules: { 
                phone: {
                    required:true,
                    isPhone:true
                },
                password: {
                    required: true,
                    isPwd: true
                },
                confirm_password: {
                    required: true,
                    isPwd: true,
                    equalTo: "#password"
                }            
                },
            messages: { 
                phone:{
                    required:"请输入手机号码"
                },        
                password: {
                    required: "请输入密码",
                    minlength: jQuery.format("密码不能小于{0}个字 符")
                },
                confirm_password: {
                    required: "请输入确认密码",
                    minlength: "确认密码不能小于5个字符",
                    equalTo: "两次输入密码不一致"
                }  
            }
      });

     });