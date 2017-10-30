$().ready(function() {
            // 手机号码验证    
                // jQuery.validator.addMethod("isPhone", function(value, element) {    
                // var length = value.length;    
                // return this.optional(element) || (length == 11 && /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(value));    
                // }, "请正确填写您的手机号码。");
            // 匹配密码，以字母开头，长度在6-12之间，必须包含数字和特殊字符。
                // jQuery.validator.addMethod("isPwd", function(value, element) {
                //     var str = value;
                //     if (str.length < 6 || str.length > 18)
                //         return false;
                //     if (!/^[a-zA-Z]/.test(str))
                //         return false;
                //     if (!/[0-9]/.test(str))
                //         return fasle;
                //     return this.optional(element) || /[^A-Za-z0-9]/.test(str);
                // }, "以字母开头，长度在6-12之间，必须包含数字和特殊字符。");

        $("#dataform").validate({
            errorElement : 'span',
            errorClass : 'help-block',
            rules: { 
                username: {
                    required:true,
                },
                email: {
                    required: true,
                }          
                },
            messages: { 
                username:{
                    required:"请输入真实姓名，以便进行登录"
                },        
                email: {
                    required: "请输入电子邮箱",
                    email:"请输入正确的邮箱格式"
                },
            }
      });

     });