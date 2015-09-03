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
						<input type="text" value="2" class="inputfield2" id="RemainingTickets" name="Remaining Tickets" disabled>
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


var spinnerSlotOneResult = 0;
var spinnerSlotTwoResult = 0;
var leverclickcounter = 0;




$('.lever-btn').on('click', function()
{
	leverclickcounter ++;
	
	spinnerSlotOneResult = 0;//reset
	spinnerSlotTwoResult = 0;//reset
	spinnerSlotThreeResult = 0;//reset

	
	
	
		var meta = $(".lever-design");
		meta.css("background-image", "-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgb(242,242,242)), color-stop(50%,rgb(147,147,147)), color-stop(62%,rgb(181,181,181)), color-stop(99%,rgb(232,232,232)))");
		meta.css("background-image", "-webkit-linear-gradient(top,  rgb(242,242,242) 0%,rgb(147,147,147) 50%,rgb(181,181,181) 62%,rgb(232,232,232) 99%)");
		meta.css("background-image", "-moz-linear-gradient(top,  rgb(242,242,242) 0%, rgb(147,147,147) 50%, rgb(181,181,181) 62%, rgb(232,232,232) 99%)");
	
	
		$('.lever-label').css("color","#3E3C38");




		$('.lever-btn').attr('disabled','disabled');//prevents lever from being pulled again while the spinner is not done yet.

		
		if(leverclickcounter == 1)
		{	
			$('#ReceiptAmount').attr('disabled','disabled');//.removeAttr('disabled');
		}
		
		
		var remainingtickets = $('#RemainingTickets').val();
		
		if($('#RemainingTickets').val() > 0)
		{
			$('#RemainingTickets').val(remainingtickets -1);
		
		
			if($('#RemainingTickets').val() == 0)
			{
				$('#ReceiptAmount').removeAttr('disabled');
			}
			resetSlots();
			//GrandWin();
			//lose();
			//majorWin();
			minorWin();
			
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
		else
		{
			$('.message').show();
		}
});

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
					
					$('.lever-btn').removeAttr('disabled');
					
					var meta = $(".lever-design");
					meta.css("background-image", "-moz-radial-gradient(45px 45px 45deg, circle cover, yellow 0%, orange 100%, red 95%))");
					meta.css("background-image", "-webkit-radial-gradient(45px 45px, circle cover, yellow, orange)");
					meta.css("background-image", "radial-gradient(45px 45px 45deg, circle cover, yellow 0%, orange 100%, red 95%)");
					
					$('.lever-label').css("color","#FF9000");

					
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





</script>
  
</body>

</html>