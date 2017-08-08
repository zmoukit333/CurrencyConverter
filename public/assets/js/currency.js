$(document).ready(function (){
		$( "#convertBtn" ).click(function(event) {
			event.preventDefault();
			
			$('#divResult').empty();
			
			var amount = $("#amount").val();
			var regex  = /^\d+(\,\d+)?$/;
			
			if($.trim(amount) == ""){
				alert("Amount is required and can't be empty.");
			}else if(!regex.test($("#amount").val())){
				alert("Invalid number.");
			}else{
				$('#divResult').prepend('<img src="'+baseUrl+'/img/giphy.gif" />')
				
				var formDataObject = new Object();

				formDataObject['amount'] = $("#amount").val();
				formDataObject['from'] 	 = $("#from").val();
				formDataObject['to'] 	 = $('#to').val();
				
				var data = { formDataObject: JSON.stringify(formDataObject)};
				
				$.ajax({
					type: "POST",
					url: baseUrl + "/index/convert",
					data: data,
					success: function(response) {

						var responseToArray = jQuery.parseJSON(response);

						if(responseToArray['status'] == "OK"){
							var from 	= responseToArray['from'];
							var to 		= responseToArray['to'];
							var amount 	= responseToArray['amount'];
							var result 	= responseToArray['result'];
							
							$('#divResult').empty();
							$('#divResult').append("<h4><strong>" + amount + " " + from + " -> " + result +" " + to + "</strong></h4>");
						}else{
							$('#divResult').empty();
							$('#divResult').append("<h4><strong style='color:red;'>An error occurred, please try again later</strong></h4>");
						}
					},
					error: function(data){
						//error
						console.log("Error ", data);
					}
				});
			}
		});
});