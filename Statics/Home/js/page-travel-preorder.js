$(document).ready(function () {
    // 日期表单
    $('#godate,#birthday').daterangepicker({
        startDate: moment().subtract(10, 'days'),
        showDropdowns: true,
        singleDatePicker: true,
    },
    function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
    // 右侧固定层
    function buffer(a, b, c) {
            var d;
            return function() {
                if(d) return;
                d = setTimeout(function() {
                    a.call(this), d = undefined
                }, b)
            }
        }(function() {
            function e() {
                var d = document.body.scrollTop || document.documentElement.scrollTop;
                d > b ? (a.className = "order-list div2", c && (a.style.top = d - b + "px")) : a.className = "order-list"
            }
            var a = document.getElementById("cost-list");
            if(a == undefined) return !1;
            var b = 0,
                c, d = a;
            while(d) b += d.offsetTop, d = d.offsetParent;
            c = window.ActiveXObject && !window.XMLHttpRequest;
            if(!c || !0) window.onscroll = buffer(e, 150, this)
        })();

});
