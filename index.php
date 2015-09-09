<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Slot Machine</title>


  <!-- Custom styles for this template -->
  <link href="style.css" rel="stylesheet">


  </head>

<body>
<div class="message"><div class="relativediv">There are no more tickets!<a href="#" class="closemessage">X</a></div></div>
<div class="container">
		<div class="machine-main-container">
			<div class="machine-top">
			</div>
			<div class="machine-center">
				
					<div class="slot-one-cont">
						<ul class="slot-one">
							<li><img src="images/result-1.jpg" class="result"></li>
							<li><img src="images/result-2.jpg" class="result"></li>
							<li><img src="images/result-3.jpg" class="result"></li>
							<li><img src="images/result-4.jpg" class="result"></li>
							<li><img src="images/result-5.jpg" class="result"></li>
							<li><img src="images/result-6.jpg" class="result"></li>
							<li><img src="images/result-7.jpg" class="result"></li>
							<li><img src="images/result-8.jpg" class="result"></li>
						</ul>
					</div>
					<div class="slot-two-cont">
						<ul class="slot-two">
							<li><img src="images/result-1.jpg" class="result"></li>
							<li><img src="images/result-2.jpg" class="result"></li>
							<li><img src="images/result-3.jpg" class="result"></li>
							<li><img src="images/result-4.jpg" class="result"></li>
							<li><img src="images/result-5.jpg" class="result"></li>
							<li><img src="images/result-6.jpg" class="result"></li>
							<li><img src="images/result-7.jpg" class="result"></li>
							<li><img src="images/result-8.jpg" class="result"></li>
						</ul>
					</div>
					<div class="slot-three-cont">
						<ul class="slot-three">
							<li><img src="images/result-1.jpg" class="result"></li>
							<li><img src="images/result-2.jpg" class="result"></li>
							<li><img src="images/result-3.jpg" class="result"></li>
							<li><img src="images/result-4.jpg" class="result"></li>
							<li><img src="images/result-5.jpg" class="result"></li>
							<li><img src="images/result-6.jpg" class="result"></li>
							<li><img src="images/result-7.jpg" class="result"></li>
							<li><img src="images/result-8.jpg" class="result"></li>
						</ul>
					</div>
			
			</div>
			<div class="machine-bottom">
				<div class="row">
					<div class="col-half">
						<!--row1col1-->
						<label for="RemainingTickets" class="inputfieldlabel2"> Remaining Tickets:</label>
						<input type="text" value="1" class="inputfield2" id="RemainingTickets" name="Remaining Tickets" disabled>
					</div>
					<div class="col-half">
						<!--row1col2-->
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-half">
							<!--row2col1-->
						</div>
					<div class="col-half">
						<!--row2col2-->
					</div>
				</div>
			</div>
		</div>
		
		<div class="machine-side">
			<button class="lever-btn">
					<div class="lever-design">
						<h4 class="lever-label">Play</h4>
					</div>
			</button>
			<div class="lever-hole-design">
			</div>
		</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  

<script>
var id_preference;//NOT really important.. id of the only row in preference table
var store_datetime_start; //DATE PART applicable only if store_date_startend_always_current == 0 . CAN ONLY WIN WITHIN THIS RANGE
var store_datetime_end;//DATE applicable only if store_date_startend_always_current == 0  . CAN ONLY WIN WITHIN THIS RANGE
var store_date_startend_always_current;//if == 1 then renew playable times everyday. if == 0, win only on set date.
var playable_duration;//precomputed duration in seconds
var playable_times; //AKA tickets.. when == zero, then you can't play anymore.
var plays_left;
var max_win_times_per_duration; //maximum number of wins per day
var wins_left;
var last_refill_datetime;

var store_time_start;// = store_datetime_start.substr(id.length - 8); . CAN ONLY WIN WITHIN THIS RANGE
var store_time_end;// = store_datetime_end.substr(id.length - 8); . CAN ONLY WIN WITHIN THIS RANGE
var last_refill_date;

var percentArray = Array.apply(null, Array(100)).map(Number.prototype.valueOf,0);// [0, 0, 0, 0, 0,...,n] array with 100 zeroes

for (i = 0; i <= 88; i++)
{
	percentArray[i] = 1;
}



/*DISABLE LEVER UNTIL API IS DONE*/
 disableLever();

$.when($.getJSON('http://192.168.10.8/slotmachine-suppliersnightBACKEND/game_start_api_v1.php')).done(function(data_from_api)
{
	$.each(data_from_api, function( index, value ) 
	{
		$.each( value, function( i, v )
		{

			if(i == 'id_preference')
			{	
				id_preference = value[i];
				
			}
			else if(i == 'store_datetime_start')
			{
				store_datetime_start = value[i];

			}
			else if(i == 'store_datetime_end')
			{
				store_datetime_end = value[i];
				
			}
			else if(i =='store_date_startend_always_current')
			{
				 store_date_startend_always_current = value[i];
				
			}
			else if(i== 'playable_duration')
			{
				playable_duration = value[i];
			}
			else if(i == 'playable_times')
			{
				playable_times = value[i];

			}
			else if(i == 'plays_left')
			{
				plays_left = value[i];
				$('#RemainingTickets').val(plays_left);
			}
			else if(i =='max_win_times_per_duration')
			{
				max_win_times_per_duration = value[i];
				
			}
			else if(i == 'wins_left')
			{
				wins_left = value[i];
				
			}
			else if(i == 'last_refill_datetime')
			{
					last_refill_datetime = value[i];
			}
		});
	 });
						  
						  
}).then(function()
{
	

	if(store_date_startend_always_current == 1)//if 1, ignores date because plays_left and wins_left  are refilled when day begins.
	{
		//store_time_start = store_datetime_start.substr(store_datetime_start.length - 8);
		//store_time_end = store_datetime_end.substr(store_datetime_end.length - 8);
	
		
		//getTimeNow. check last refill date time.. if not refilled for today, refill. 
		var datenow_expld = getDateNow().split('-');
		var datenow_YEAR = datenow_expld[0];
		var datenow_MONTH = datenow_expld[1];
		var datenow_DATE = datenow_expld[2];
		
		var datenow_NEWFORMAT = datenow_MONTH+'/'+datenow_DATE+'/'+datenow_YEAR;
		
		
		last_refill_date = last_refill_datetime.substr(0,10);
		var last_refill_date_expld = last_refill_date.split('-');
		var last_refill_date_YEAR =last_refill_date_expld[0];
		var last_refill_date_MONTH =last_refill_date_expld[1];
		var last_refill_date_DATE =last_refill_date_expld[2];
		
		var last_refill_date_NEWFORMAT = last_refill_date_MONTH+'/'+last_refill_date_DATE+'/'+last_refill_date_YEAR;
		
		alert(wins_left);

			if(compareDates(last_refill_date_NEWFORMAT,datenow_NEWFORMAT)== true)//if date now is greater than last refill date
			{

				$.ajax(
				{
				   type: "POST",
				   url: "http://192.168.10.8/slotmachine-suppliersnightBACKEND/process_update_last_refill_datetime_field.php",
				   data: {"last_refill_datetime":getDateTimeNow(),"wins_left":max_win_times_per_duration,"plays_left":playable_times},
				   datatype: "json",
				   cache: false,
				   success: function(data)
				   {
					   $('#RemainingTickets').val(playable_times);
					   wins_left = max_win_times_per_duration;
					   alert(data);
					   alert(wins_left);
				   }
				});
			}
			/*else
			{
				alert('already refilled today');
			}*/
		
	}

	
	/*ENABLE LEVER WHEN READY TO START PLAYING*/
	enableLever();

});




var spinnerSlotOneResult = 0;
var spinnerSlotTwoResult = 0;
var leverclickcounter = 0;




$('.lever-btn').on('click', function()
{


	
	leverclickcounter ++;
	
	spinnerSlotOneResult = 0;//reset
	spinnerSlotTwoResult = 0;//reset
	spinnerSlotThreeResult = 0;//reset

	

	 disableLever();


		
		
		var remainingtickets = $('#RemainingTickets').val();
		
		if($('#RemainingTickets').val() > 0)
		{
			$('#RemainingTickets').val(remainingtickets -1);
			

				$.ajax(
				{
				   type: "POST",
				   url: "http://192.168.10.8/slotmachine-suppliersnightBACKEND/process_update_plays_left_field.php",
				   data: {"playsleft":remainingtickets-1},
				   datatype: "json",
				   cache: false,
				   success: function(data)
				   {

						resetSlots();
						
						
						if(store_date_startend_always_current == 1)//if 1, ignores date because plays_left and wins_left  are refilled when day begins.
						{
							store_time_start = store_datetime_start.substr(store_datetime_start.length - 8);
							store_time_end = store_datetime_end.substr(store_datetime_end.length - 8);
							
							var start_expld = store_time_start.split(':');
							var end_expld = store_time_end.split(':');

							var start_time_hours = start_expld[0];
							var start_time_minutes = start_expld[1];
							//var start_time_seconds = start_expld[2];
							
							var end_time_hours = end_expld[0];
							var end_time_minutes = end_expld[1];
							//var end_time_seconds = end_expld[2];
							
							alert(start_time_hours+':'+start_time_minutes+'-'+end_time_hours+':'+end_time_minutes);
							
							if(checkIfTimeWithinTimeRange(start_time_hours,start_time_minutes,end_time_hours,end_time_minutes) == true)
							{
								alert('win or lose algo.');
								GrandWin();
								//lose();
								//majorWin();
								//minorWin();
							}
							else
							{
								//alert('should be always lose() but since only grandWin is considered a win, majorWin and minorWin will be considered as lose() as well. randomize goes here.');
								
								
								var consideredLoseArr= ['lose','majorWin','minorWin'];
								var randomFromArray = randomFrom(consideredLoseArr);
								if(randomFromArray  == 'lose')
								{
									lose();
									console.log(randomFromArray);
								}
								else if(randomFromArray  == 'majorWin')
								{
									majorWin();
									console.log(randomFromArray);
								}
								else if(randomFromArray  == 'minorWin')
								{
									minorWin();
									console.log(randomFromArray);
								}
								else
								{
									console.log(randomFromArray);
									alert('that wasnt supposed to happen');
								}
								

							}
						}
						else
						{
							alert('consider set date code goes here.');
						}
						
						var windowwidth = $(window).width();
						//Please keep these the same as mediaqueries in style.css
						

						if(windowwidth > 632)
						{
							leverDownAnimation(420,420);
						}
						else if(windowwidth <= 632 && windowwidth > 567)
						{
							leverDownAnimation(400,400);
						}
						else if(windowwidth <= 567 && windowwidth > 497)
						{
							leverDownAnimation(380,380);
						}
						else if((windowwidth <= 497 && windowwidth > 425)
									|| (windowwidth <= 425 && windowwidth > 373))
						{
							leverDownAnimation(340,340);
						}
				   }
				});
		


		}
		else
		{
			$('.message').show();
		}
});



function randomFrom(array)
{
	return array[Math.floor(Math.random() * array.length)];
}




$('.closemessage').on('click',function(){$('.message').hide();});

function leverDownAnimation(down,up)
{
		$('.lever-btn').animate({top: '+='+down+'px'}, 500);
		$('.lever-btn').animate({top: '-='+up+'px'}, 1000);
}

function spinner(whichSlot,durationPerResult,maxSpinTimes,randomResult)
{
	if(whichSlot == "ul.slot-three")
	{
		var randomSpeed = 140;//ensures that slot-three always finishes last
	}
	else
	{
		var randomSpeed = Math.floor(Math.random() * 30) + 100;
		
	}
	
	
	var currentResult = 1;
	var Allowednumberofspins = Math.floor(Math.random() * maxSpinTimes) + 2;
	var numberofspinscounter = 1;

	 var myVar =  setInterval(function()
   {


	  currentResult++;
		
	  $(whichSlot).animate({marginTop:-166.65},randomSpeed,function()
	  {
		 $(this).css({marginTop:0}).find("li:last").after($(this).find("li:first"));
	  })
	  
	 
	  if(currentResult%8 == 0)
	  {
		currentResult = 8;
		numberofspinscounter++;
		
	  }
	  else
	  {
		currentResult = currentResult%8;
	  }
	  
			if(currentResult == randomResult && numberofspinscounter >= Allowednumberofspins)
		  {
			clearInterval(myVar);
			
			if(whichSlot == "ul.slot-three")//only enable when ul.slot-three is done with animation
			{
				setTimeout(function()
				{
					
					enableLever();

					
				},1500);
			}
		  }
		

		
	  
   }, durationPerResult);
	
	
}

function lose()
{

	var arr = []
	while(arr.length < 3){
	  var randomnumber=Math.ceil(Math.random()*8)
	  var found=false;
	  for(var i=0;i<arr.length;i++){
		if(arr[i]==randomnumber){found=true;break}
	  }
	  if(!found)arr[arr.length]=randomnumber;
	}


	spinner("ul.slot-one",0,3,arr[0]);
	setTimeout(function()
	{
		spinner("ul.slot-two",100,4,arr[1]);
	}, 800);
	
	setTimeout(function()
	{

		spinner("ul.slot-three",120,5,arr[2]);
	}, 1200);

}

function majorWin()
{

	var arr = []
	while(arr.length < 1)
	{
	  var randomnumber=Math.ceil(Math.random()*7)
	  var found=false;
	  for(var i=0;i<arr.length;i++)
	  {
		if(arr[i]==randomnumber){found=true;break}
	  }
	  if(!found)arr[arr.length]=randomnumber;
	}


	spinner("ul.slot-one",0,3,arr[0]);
	setTimeout(function()
	{
		spinner("ul.slot-two",100,4,arr[0]);
	}, 800);
	
	setTimeout(function()
	{

		spinner("ul.slot-three",120,5,arr[0]);
	}, 1200);
}

function GrandWin()
{
	//GrandWinSpinner("ul.slot-one",0,3);
	spinner("ul.slot-one",0,3,8);
	
	
	setTimeout(function()
	{
		//GrandWinSpinner("ul.slot-two",100,4);
		spinner("ul.slot-two",100,4,8);
	}, 800);
	
	setTimeout(function()
	{

		//GrandWinSpinner("ul.slot-three",120,7);
		spinner("ul.slot-three",100,4,8);
	}, 1200);
	

}

function minorWin()
{
	var winType = Math.floor(Math.random() * 3) + 1;
	var arr = []
	while(arr.length < 2)
	{
	  var randomnumber=Math.ceil(Math.random()*8)
	  var found=false;
	  for(var i=0;i<arr.length;i++)
	  {
		if(arr[i]==randomnumber){found=true;break}
	  }
	  if(!found)arr[arr.length]=randomnumber;
	}

	
	if(winType == 1)
	{
		spinner("ul.slot-one",0,3,arr[0]);
	
	
		setTimeout(function()
		{
			//GrandWinSpinner("ul.slot-two",100,4);
			spinner("ul.slot-two",100,4,arr[0]);
		}, 800);
		
		setTimeout(function()
		{

			//GrandWinSpinner("ul.slot-three",120,7);
			spinner("ul.slot-three",100,4,arr[1]);
		}, 1200);
	}
	else if(winType == 2)
	{
		spinner("ul.slot-one",0,3,arr[0]);
	
	
		setTimeout(function()
		{
			//GrandWinSpinner("ul.slot-two",100,4);
			spinner("ul.slot-two",100,4,arr[1]);
		}, 800);
		
		setTimeout(function()
		{

			//GrandWinSpinner("ul.slot-three",120,7);
			spinner("ul.slot-three",100,4,arr[0]);
		}, 1200);
	}
	else if(winType == 3)
	{
		spinner("ul.slot-one",0,3,arr[1]);
	
	
		setTimeout(function()
		{
			//GrandWinSpinner("ul.slot-two",100,4);
			spinner("ul.slot-two",100,4,arr[0]);
		}, 800);
		
		setTimeout(function()
		{

			//GrandWinSpinner("ul.slot-three",120,7);
			spinner("ul.slot-three",100,4,arr[0]);
		}, 1200);
	}
	

}

function resetSlots()
{
  $('ul.slot-one , ul.slot-two , ul.slot-three').empty();
  $('ul.slot-one , ul.slot-two , ul.slot-three').append('<li><img src="images/result-1.jpg" class="result"></li><li><img src="images/result-2.jpg" class="result"></li><li><img src="images/result-3.jpg" class="result"></li><li><img src="images/result-4.jpg" class="result"></li><li><img src="images/result-5.jpg" class="result"></li><li><img src="images/result-6.jpg" class="result"></li><li><img src="images/result-7.jpg" class="result"></li><li><img src="images/result-8.jpg" class="result"></li>')
  
}


function enableLever()
{
		$('.lever-btn').removeAttr('disabled');	
		var meta = $(".lever-design");
	meta.css("background-image", "-moz-radial-gradient(45px 45px 45deg, circle cover, yellow 0%, orange 100%, red 95%)");
	meta.css("background-image", "-webkit-radial-gradient(45px 45px, circle cover, yellow, orange)");
	meta.css("background-image", "radial-gradient(45px 45px 45deg, circle cover, yellow 0%, orange 100%, red 95%)");
	
	$('.lever-label').css("color","#FF9000");
}

function disableLever()
{
		var meta = $(".lever-design");
		meta.css("background-image", "-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgb(242,242,242)), color-stop(50%,rgb(147,147,147)), color-stop(62%,rgb(181,181,181)), color-stop(99%,rgb(232,232,232)))");
		meta.css("background-image", "-webkit-linear-gradient(top,  rgb(242,242,242) 0%,rgb(147,147,147) 50%,rgb(181,181,181) 62%,rgb(232,232,232) 99%)");
		meta.css("background-image", "-moz-linear-gradient(top,  rgb(242,242,242) 0%, rgb(147,147,147) 50%, rgb(181,181,181) 62%, rgb(232,232,232) 99%)");
	
	
		$('.lever-label').css("color","#3E3C38");




		$('.lever-btn').attr('disabled','disabled');//prevents lever from being pulled again while the spinner is not done yet.

		
}

function getDateNow()
{
	var DateTimeNow = new Date();
	var DateNow = DateTimeNow.getFullYear() + '-' +  (( DateTimeNow.getMonth()+1 < 10 && DateTimeNow.getMonth() >= 0) ? '0'+(DateTimeNow.getMonth()+1) : DateTimeNow.getMonth()+1) + '-' +  (( DateTimeNow.getDate() < 10 && DateTimeNow.getDate() >= 0) ? '0'+DateTimeNow.getDate() : DateTimeNow.getDate()) ;

	
	return DateNow;
}

function getTimeNow()
{
	var DateTimeNow = new Date();

	var TimeNow = (( DateTimeNow.getHours() < 10 && DateTimeNow.getHours() >= 0) ? '0'+DateTimeNow.getHours() : DateTimeNow.getHours()) + ':' + (( DateTimeNow.getMinutes() < 10 && DateTimeNow.getMinutes() > 0) ? '0'+DateTimeNow.getMinutes() : DateTimeNow.getMinutes())+ ':' + ((DateTimeNow.getSeconds() < 10 && DateTimeNow.getSeconds() > 0)?  '0'+DateTimeNow.getSeconds() : DateTimeNow.getSeconds());
	
	return TimeNow;
}

function getDateTimeNow()
{
	return getDateNow() + ' '+getTimeNow();
}

function checkIfTimeWithinTimeRange(extractedStartHour,extractedStartMinute,extractedEndHour,extractedEndMinute)
{
	var currentTime = new Date();
	var startTime = new Date();
	startTime.setHours(extractedStartHour);
	startTime.setMinutes(extractedStartMinute);
	var endTime = new Date();
	endTime.setHours(extractedEndHour);
	endTime.setMinutes(extractedEndMinute);

	if ((currentTime.getTime() > startTime.getTime()) && (currentTime.getTime() < endTime.getTime()))
	{
	   return true;
	}
	else
	{
		return false;
	}
}

function compareDates(date1, date2) {
    return new Date(date1) < new Date(date2);
}
//alert(compareDates("1/1/2003", "1/2/2003"));  // returns true
//alert(compareDates("1/3/2003", "1/2/2003")); //returns false


</script>
  
</body>

</html>