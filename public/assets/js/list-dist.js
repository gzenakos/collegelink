jQuery(document).ready((function(t){jQuery.ready.then((function(t){t("#check-in-date").datepicker({dateFormat:"dd-mm-yy"}),t("#check-out-date").datepicker({dateFormat:"dd-mm-yy"});var a=t("#amount-min").val().split(" ")[0],e=t("#amount-max").val().split(" ")[0];t("#slider-range").slider({range:!0,min:0,max:1e3,values:[a,e],slide:function(a,e){t("#amount-min").val(e.values[0]+" €"),t("#amount-max").val(e.values[1]+" €")}})})),t(document).on("submit","form.searchFormList",(function(a){a.preventDefault();const e=t(this).serialize();t.ajax("http://hotel.collegelink.localhost/public/ajax/search_results.php",{type:"Get",dataType:"html",data:e}).done((function(a){t("#search-results-container").html(""),t("#search-results-container").html(a),history.pushState({},"",window.location.origin+window.location.pathname+"?"+e)}))}))}));