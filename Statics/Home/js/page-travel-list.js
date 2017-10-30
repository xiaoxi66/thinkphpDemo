 $(function(){
	 // autocomplete 
	 
		var availableTags = [
			"北京",
			"上海",
			"南京",
			"贵州",
			"三亚",
			"井冈山",
			"北京-上海-贵州",
			"贵州-湖南",
			"深圳-广州",
			"云南-香格里拉",
			"海南-三亚",
			"厦门-三亚",
			"北京-秦皇岛-青岛",
			"北京-保定-承德",
			"北京-廊坊",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});
	
	//city dropdown-choose 

       var test = new Vcity.CitySelector({input:'citySelect'});
	   $("#dropdown .choosed").click(function(){
		var ul = $("#dropdown ul");
		if(ul.css("display")=="none"){
			ul.slideDown("fast");
		}else{
			ul.slideUp("fast");
		}
		});
		
		$("#dropdown ul li a").click(function(){
			var txt = $(this).text();
			$("#dropdown .choosed").html(txt);
			var value = $(this).attr("rel");
			$("#dropdown ul").hide();
		});
	});