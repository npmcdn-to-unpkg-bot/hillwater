function index_content_load(){
	$.ajax({
		url:"./server.php/get_index_content",
		data:{},
		dataType:"json",
		beforeSend:function(){
			$("#left_content").html("load.....");
		},
		success:function(data){	
			if(data.status === 0){
				$("#left_content").empty();
				$.each(data.data,function(i,obj){
					str =obj.tag;
					var strs = new Array();
					strs = str.split(",");
					main_img = obj.main_img;
					sub ="<div class='left aniview' av-animation='fadeIn'>"+
							"<div class='left_one col-md-12'>"+
								"<a href=''>"+
									"<img class='' src='./IMG/"+main_img+"'>"+
								"</a>"+
							"</div>"+
							"<div class='col-md-12' style='padding-bottom:10px;'>"+
								"<h3>"+obj.title+"</h3>"+
							"</div>"+
							"<div class='col-md-12'>"+
								"<div>"+
									"<div class='post-icon'>"+
										"<i class='glyphicon glyphicon-pencil'></i>"+
									"</div>"+
									"<span class='span_s'>"+obj.created_at+"</span>";
									for(i=0;i<strs.length;i++){
										sub +="<span class='span_s'><em>•&nbsp;<a target='_blank' href='./tag_search.html?tag="+strs[i]+"'>"+strs[i]+"</a></em></span>";
									};
								sub +="</div>"+
							"</div>"+
							"<div class='_line col-md-12'></div>"+
							"<div class='fm col-md-12'>"+obj.about+
							"</div>"+
							"<div style='padding-top:25px;' class='col-md-12'>"+
								"<a href='./all/"+obj.created_at+"/' class='blogmore' target='_blank'>查看详情</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
								"<a href='./all/"+obj.created_at+"/"+obj.file+"' class='shake-vertical blogmore' target='_blank'>下载源码</a>"+
							"</div>"+
							"<div class='h_line col-md-12'></div>"+
							"<div class='bl _line col-md-12'></div>"+
						"</div>";
						sub += "<div class='row'>"+
                	"<div 'class=col-md-6 col-md-offset-3 aniview box green' 'av-animation=rotateInUpRight'>"+
                	"</div>"+
           		"</div>";
								
								sub += "<script>"+
						"$(document).ready(function(){"+
							"var i={animateThreshold:20,};"+
							"$('.aniview').AniView(i)"+
						"});"+
						"</script>";
					$("#left_content").append(sub);
				});
				
			}else{
				alert(data.status);
			}	
		}
	});
		$.get("./server.php/get_all_count",function(data,status){
			if(data.status === 0){
				count = data.data;
				display = 5;
				$("#page").paginate({
				count 		: count,
				start 		: 1,
				display     : display,
				border					: false,
						text_color  			: '#79B5E3',
						background_color    	: 'none',	
						text_hover_color  		: '#2573AF',
						background_hover_color	: 'none', 
						images		: false,
						mouse		: 'press',
				onChange     			: function(page){
					$.ajax({
						url:"./server.php/get_content",
						data:{page:page,display:display},
						
						beforeSend:function(){
							$("#left_content").html("load.....");
						},
						success:function(data){
							$("#left_content").empty();
							$.each(data.data,function(i,obj){	
								str = obj.tag;
								console.log(obj.main_img);
								var img = obj.main_img;
								var strs=new Array();
								strs = str.split(",");			
								//$("#left_content").append(
								 sub ="<div class='left aniview' av-animation='fadeIn'>"+
							"<div class='left_one col-md-12'>"+
								"<a href=''>"+
									"<img class='' value='"+obj.title+"' src='./IMG/"+img+"'>"+
								"</a>"+
							"</div>"+
							"<div class='col-md-12' style='padding-bottom:10px;'>"+
								"<h3>"+obj.title+"</h3>"+
							"</div>"+
							"<div class='col-md-12'>"+
								"<div>"+
									"<div class='post-icon'>"+
										"<i class='glyphicon glyphicon-pencil'></i>"+
									"</div>"+
									"<span class='span_s'>"+obj.created_at+"</span>";
									for(i=0;i<strs.length;i++){
										sub +="<span class='span_s'><em>•&nbsp;<a target='_blank' href='./tag_search.html?tag="+strs[i]+"'>"+strs[i]+"</a></em></span>";
									};
								sub +="</div>"+
							"</div>"+
							"<div class='_line col-md-12'></div>"+
							"<div class='fm col-md-12'>"+obj.about+
							"</div>"+
							"<div style='padding-top:25px;' class='col-md-12'>"+
								"<a href='./all/"+obj.created_at+"/' class='blogmore' target='_blank'>查看详情</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
								"<a href='./all/"+obj.created_at+"/"+obj.file+"' class='shake-vertical blogmore' target='_blank'>下载源码</a>"+
							"</div>"+
							"<div class='h_line col-md-12'></div>"+
							"<div class='bl _line col-md-12'></div>"+
						"</div>";
						sub += "<div class='row'>"+
                	"<div 'class=col-md-6 col-md-offset-3 aniview box green' 'av-animation=rotateInUpRight'>"+
                	"</div>"+
           		"</div>";
								
								sub += "<script>"+
						"$(document).ready(function(){"+
							"var i={animateThreshold:20,};"+
							"$('.aniview').AniView(i)"+
						"});"+
						"</script>";
					$("#left_content").append(sub);
				});		
						},
						complete:function(){
							
						},
					});		
				}
				});
			}else{
				alert(data.status);
			}

	});

}

function tag_search_get(){
	var str = window.location.search;
	var s = str.substring(5);
	var skip = 0;
	var take = 5;
	$.ajax({
		url:"./server.php/tag_search",
		data:{tag:s,skip:skip,take:take},
		dataType:"json",
		beforeSend:function(){
			$("#left_content").html("load.....");
		},
		success:function(data){	
			alert('123);');
			if(data.status === 0){
				$("#left_content").empty();
				$.each(data.data,function(i,obj){
					str =obj.tag;
					var strs = new Array();
					strs = str.split(",");
					main_img = obj.main_img;
					sub ="<div class='left aniview' av-animation='fadeIn'>"+
							"<div class='left_one col-md-12'>"+
								"<a href=''>"+
									"<img class='' src='./IMG/"+main_img+"'>"+
								"</a>"+
							"</div>"+
							"<div class='col-md-12' style='padding-bottom:10px;'>"+
								"<h3>"+obj.title+"</h3>"+
							"</div>"+
							"<div class='col-md-12'>"+
								"<div>"+
									"<div class='post-icon'>"+
										"<i class='glyphicon glyphicon-pencil'></i>"+
									"</div>"+
									"<span class='span_s'>"+obj.created_at+"</span>";
									for(i=0;i<strs.length;i++){
										sub +="<span class='span_s'><em>•&nbsp;<a target='_blank' href='./tag_search.html?tag="+strs[i]+"'>"+strs[i]+"</a></em></span>";
									};
								sub +="</div>"+
							"</div>"+
							"<div class='_line col-md-12'></div>"+
							"<div class='fm col-md-12'>"+obj.about+
							"</div>"+
							"<div style='padding-top:25px;' class='col-md-12'>"+
								"<a href='./all/"+obj.id+"/' class='blogmore' target='_blank'>查看详情</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
								"<a href='./all/"+obj.id+"/"+obj.file+"' class='shake-vertical blogmore' target='_blank'>下载源码</a>"+
							"</div>"+
							"<div class='h_line col-md-12'></div>"+
							"<div class='bl _line col-md-12'></div>"+
						"</div>";
						sub += "<div class='row'>"+
                	"<div 'class=col-md-6 col-md-offset-3 aniview box green' 'av-animation=rotateInUpRight'>"+
                	"</div>"+
           		"</div>";
								
								sub += "<script>"+
						"$(document).ready(function(){"+
							"var i={animateThreshold:20,};"+
							"$('.aniview').AniView(i)"+
						"});"+
						"</script>";
					$("#left_content").append(sub);
				});		
			}else{
				alert(data.status);
			}	
		}
	});
	$.get("./server.php/get_tag_all_count?tag="+s,function(data,status){
			if(data.status === 0){			
				count = data.data;
				display = 5;
				$("#page").paginate({
				count 		: count,
				start 		: 1,
				display     : display,
				border					: false,
						text_color  			: '#79B5E3',
						background_color    	: 'none',	
						text_hover_color  		: '#2573AF',
						background_hover_color	: 'none', 
						images		: false,
						mouse		: 'press',
				onChange     			: function(page){
					$.ajax({
						url:"./server.php/tag_search?tag="+s,
						data:{skip:page,take:display},
						
						beforeSend:function(){
							$("#left_content").html("load.....");
						},
						success:function(data){
							$("#left_content").empty();
							$.each(data.data,function(i,obj){	
								str = obj.tag;
								var strs=new Array();
								strs = str.split(",");			
								//$("#left_content").append(
								sub ="<div class='left aniview' av-animation='fadeIn'>"+
							"<div class='left_one col-md-12'>"+
								"<a href=''>"+
									"<img class='' src='./IMG/"+main_img+"'>"+
								"</a>"+
							"</div>"+
							"<div class='col-md-12' style='padding-bottom:10px;'>"+
								"<h3>"+obj.title+"</h3>"+
							"</div>"+
							"<div class='col-md-12'>"+
								"<div>"+
									"<div class='post-icon'>"+
										"<i class='glyphicon glyphicon-pencil'></i>"+
									"</div>"+
									"<span class='span_s'>"+obj.created_at+"</span>";
									for(i=0;i<strs.length;i++){
										sub +="<span class='span_s'><em>•&nbsp;<a target='_blank' href='./tag_search.html?tag="+strs[i]+"'>"+strs[i]+"</a></em></span>";
									};
								sub +="</div>"+
							"</div>"+
							"<div class='_line col-md-12'></div>"+
							"<div class='fm col-md-12'>"+obj.about+
							"</div>"+
							"<div style='padding-top:25px;' class='col-md-12'>"+
								"<a href='./all/"+obj.id+"/' class='blogmore' target='_blank'>查看详情</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
								"<a href='./all/"+obj.id+"/"+obj.file+"' class='shake-vertical blogmore' target='_blank'>下载源码</a>"+
							"</div>"+
							"<div class='h_line col-md-12'></div>"+
							"<div class='bl _line col-md-12'></div>"+
						"</div>";
						sub += "<div class='row'>"+
                	"<div 'class=col-md-6 col-md-offset-3 aniview box green' 'av-animation=rotateInUpRight'>"+
                	"</div>"+
           		"</div>";
								
								sub += "<script>"+
						"$(document).ready(function(){"+
							"var i={animateThreshold:20,};"+
							"$('.aniview').AniView(i)"+
						"});"+
						"</script>";
					$("#left_content").append(sub);
				});						
						},
						complete:function(){
							
						},
					});		
				}
				});
			}else{
				alert(data.status);
			}

	});
}

