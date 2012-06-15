(function($){$.fn.jCarouselLite=function(o){o=$.extend({btnPrev:null,btnNext:null,btnGo:null,mouseWheel:false,auto:null,wrapper:'ul',element:'li',speed:200,easing:null,vertical:false,circular:true,visible:3,start:0,scroll:1,beforeStart:null,afterEnd:null},o||{});return this.each(function(){var running=false,animCss=o.vertical?"top":"left",sizeCss=o.vertical?"height":"width";var div=$(this),ul=$(o.wrapper,div),tLi=$(o.element,ul),tl=tLi.size(),v=o.visible;if(o.circular){ul.prepend(tLi.slice(tl-v-1+1).clone()).append(tLi.slice(0,v).clone());o.start+=v;}
var li=$(o.element,ul),itemLength=li.size(),curr=o.start;div.css("visibility","visible");li.css({display:"block",overflow:"hidden",float:o.vertical?"none":"left"});ul.css({margin:"0",padding:"0",position:"relative","list-style-type":"none","z-index":"1"});div.css({overflow:"hidden",position:"relative","z-index":"2",left:"0px"});var liSize=o.vertical?height(li):width(li);var ulSize=liSize*itemLength;var divSize=liSize*v;li.css({width:li.width(),height:li.height()});ul.css(sizeCss,ulSize+"px").css(animCss,-(curr*liSize));div.css(sizeCss,divSize+"px");if(o.btnPrev){$(this).find(o.btnPrev).click(function(){return go(curr-o.scroll);});}
if(o.btnNext){$(this).find(o.btnNext).click(function(){return go(curr+o.scroll);});}
if((o.btnPrev)||(o.btnNext)){$(this).find(o.btnPrev).fadeIn('slow');$(this).find(o.btnNext).fadeIn('slow');}
if(o.btnGo)
$.each(o.btnGo,function(i,val){$(val).click(function(){return go(o.circular?o.visible+i:i);});});if(o.mouseWheel&&div.mousewheel)
div.mousewheel(function(e,d){return d>0?go(curr-o.scroll):go(curr+o.scroll);});if(o.auto)
setInterval(function(){go(curr+o.scroll);},o.auto+o.speed);function vis(){return li.slice(curr).slice(0,v);};function go(to){if(!running){if(o.beforeStart)
o.beforeStart.call(this,vis(),curr);if(o.circular){if(to<=o.start-v-1){ul.css(animCss,-((itemLength-(v*2))*liSize)+"px");curr=to==o.start-v-1?itemLength-(v*2)-1:itemLength-(v*2)-o.scroll;}else if(to>=itemLength-v+1){ul.css(animCss,-((v)*liSize)+"px");curr=to==itemLength-v+1?v+1:v+o.scroll;}else curr=to;}else{if(to<0||to>itemLength-v)return;else curr=to;}
running=true;ul.animate(animCss=="left"?{left:-(curr*liSize)}:{top:-(curr*liSize)},o.speed,o.easing,function(){if(o.afterEnd)
o.afterEnd.call(this,vis(),curr);running=false;});if(!o.circular){$(o.btnPrev+","+o.btnNext).removeClass("disabled");$((curr-o.scroll<0&&o.btnPrev)||(curr+o.scroll>itemLength-v&&o.btnNext)||[]).addClass("disabled");}}
return false;};});};function css(el,prop){return parseInt($.css(el[0],prop))||0;};function width(el){return el[0].offsetWidth+css(el,'marginLeft')+css(el,'marginRight');};function height(el){return el[0].offsetHeight+css(el,'marginTop')+css(el,'marginBottom');};})(jQuery);WPOLL={};WPOLL.poll_id=0;WPOLL.poll_answer_id="";WPOLL.is_being_voted=false;WPOLL.pollsL10n={};WPOLL.pollsL10n.show_loading=1;WPOLL.pollsL10n.show_fading=1;WPOLL.pollsL10n.ajax_url="wp-content/plugins/wp-polls/wp-polls.php";
WPOLL.pollsL10n.text_wait="Your last request is still being processed. Please wait a while ...";WPOLL.pollsL10n.text_valid="Please choose a valid poll answer.";WPOLL.pollsL10n.text_multiple="Maximum number of choices allowed: ";
WPOLL.fixloading=function(a,e){var c=a.parents(".wp-polls").parent();var d=c.find(e);if((c.length==1)&&(d.length==1)){var b=c.find(".wp-polls").height()+"px";d.height(b).css("line-height",b)}};$(".wp-polls form").submit(function(){WPOLL.fixloading($(this),".wp-polls-loading");
if(!WPOLL.is_being_voted){WPOLL.set_is_being_voted(true);WPOLL.poll_id=$(this).find("input[name='poll_id']").val();WPOLL.poll_answer_id="";poll_multiple_ans=0;poll_multiple_ans_count=0;if($("#poll_multiple_ans_"+WPOLL.poll_id).length){poll_multiple_ans=parseInt($("#poll_multiple_ans_"+WPOLL.poll_id).val())
}$(this).find("input").each(function(a){if($(this).is(":checked")){if(poll_multiple_ans>0){WPOLL.poll_answer_id=$(this).val()+","+WPOLL.poll_answer_id;poll_multiple_ans_count++}else{WPOLL.poll_answer_id=parseInt($(this).val())
}}});if(poll_multiple_ans>0){if(poll_multiple_ans_count>0&&poll_multiple_ans_count<=poll_multiple_ans){WPOLL.poll_answer_id=WPOLL.poll_answer_id.substring(0,(WPOLL.poll_answer_id.length-1));WPOLL.poll_process()
}else{if(poll_multiple_ans_count==0){WPOLL.set_is_being_voted(false);alert(WPOLL.pollsL10n.text_valid)}else{WPOLL.set_is_being_voted(false);alert(WPOLL.pollsL10n.text_multiple+" "+poll_multiple_ans)}}}else{if(WPOLL.poll_answer_id>0){WPOLL.poll_process()
}else{WPOLL.set_is_being_voted(false);alert(WPOLL.pollsL10n.text_valid)}}}else{alert(WPOLL.pollsL10n.text_wait)}return false});$(".wp-polls .see-results").click(function(){WPOLL.fixloading($(this),".wp-polls-loading");
if(!WPOLL.is_being_voted){WPOLL.set_is_being_voted(true);WPOLL.poll_id=$(this).data("poll");if(WPOLL.pollsL10n.show_fading){$("#polls-"+WPOLL.poll_id).fadeTo("def",0,function(){if(WPOLL.pollsL10n.show_loading){$("#polls-"+WPOLL.poll_id+"-loading").show()
}$.ajax({type:"GET",url:WPOLL.pollsL10n.ajax_url,data:"pollresult="+WPOLL.poll_id,cache:false,success:WPOLL.poll_process_success})})}else{if(WPOLL.pollsL10n.show_loading){$("#polls-"+WPOLL.poll_id+"-loading").show()
}$.ajax({type:"GET",url:WPOLL.pollsL10n.ajax_url,data:"pollresult="+WPOLL.poll_id,cache:false,success:WPOLL.poll_process_success})}}else{alert(WPOLL.pollsL10n.text_wait)}return false});WPOLL.poll_process=function(){if(WPOLL.pollsL10n.show_fading){$("#polls-"+WPOLL.poll_id).fadeTo("def",0,function(){if(WPOLL.pollsL10n.show_loading){$("#polls-"+WPOLL.poll_id+"-loading").show()
}$.ajax({type:"POST",url:WPOLL.pollsL10n.ajax_url,data:"vote=true&poll_id="+WPOLL.poll_id+"&poll_"+WPOLL.poll_id+"="+WPOLL.poll_answer_id,cache:false,success:WPOLL.poll_process_success})})}else{if(WPOLL.pollsL10n.show_loading){$("#polls-"+WPOLL.poll_id+"-loading").show()
}$.ajax({type:"POST",url:WPOLL.pollsL10n.ajax_url,data:"vote=true&poll_id="+WPOLL.poll_id+"&poll_"+WPOLL.poll_id+"="+WPOLL.poll_answer_id,cache:false,success:WPOLL.poll_process_success})}};WPOLL.poll_process_success=function(a){$("#polls-"+WPOLL.poll_id).replaceWith(a);
if(WPOLL.pollsL10n.show_loading){$("#polls-"+WPOLL.poll_id+"-loading").hide()}if(WPOLL.pollsL10n.show_fading){$("#polls-"+WPOLL.poll_id).fadeTo("def",1,function(){WPOLL.set_is_being_voted(false)})}else{WPOLL.set_is_being_voted(false)
}};WPOLL.set_is_being_voted=function(a){WPOLL.is_being_voted=a};(function(e,a,f){var c,b=e.getElementsByTagName(a)[0];if(e.getElementById(f)){return}c=e.createElement(a);c.id=f;c.src="//connect.facebook.net/es_LA/all.js#xfbml=1&appId=322236784515173";b.parentNode.insertBefore(c,b)
}(document,"script","facebook-jssdk"));!function(e,a,f){var c,b=e.getElementsByTagName(a)[0];if(!e.getElementById(f)){c=e.createElement(a);c.id=f;c.src="//platform.twitter.com/widgets.js";b.parentNode.insertBefore(c,b)
}}(document,"script","twitter-wjs");$(document).ready(function(){switch($("body").data("page")){case"home":$("#featured-carousel").jCarouselLite({btnNext:".next",btnPrev:".prev",wrapper:".carousel-wrapper",element:"article",visible:1,auto:$("#featured-carousel").data("auto")?$("#featured-carousel").data("auto"):5000,speed:$("#featured-carousel").data("speed")?$("#featured-carousel").data("speed"):500});
$("#footer-carousel").jCarouselLite({btnNext:".next",btnPrev:".prev",wrapper:".carousel-wrapper",element:"article",visible:1,auto:$("#footer-carousel").data("auto")?$("#footer-carousel").data("auto"):5000,speed:$("#footer-carousel").data("speed")?$("#footer-carousel").data("speed"):500});
break}$("#ranking .carousel-wrapper").css("height",$("#ranking .first").height());$("#ranking").jCarouselLite({btnNext:".next",btnPrev:".prev",wrapper:".carousel-wrapper",element:"ul",visible:1,circular:false,speed:$("#ranking").data("speed")?$("#ranking").data("speed"):500,afterEnd:function(a,c){$("#ranking div").removeClass("selected");
$("#ranking div:eq("+(c)+")").addClass("selected");var b=0;a.find("li").each(function(d){b+=$(this).outerHeight(true)});$("#ranking .carousel-wrapper ul").css("height",b+"px");$("#ranking .carousel-wrapper").animate({height:b})
}});if(!Modernizr.input.placeholder){$("[placeholder]").focus(function(){var a=$(this);if(a.val()==a.attr("placeholder")){a.val("");a.removeClass("placeholder")}}).blur(function(){var a=$(this);if(a.val()==""||a.val()==a.attr("placeholder")){a.addClass("placeholder");
a.val(a.attr("placeholder"))}}).blur();$("[placeholder]").parents("form").submit(function(){$(this).find("[placeholder]").each(function(){var a=$(this);if(a.val()==a.attr("placeholder")){a.val("")}})})
}$("body").addClass("js-finished")});