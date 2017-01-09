							var START_LAT = 0;
							var STOP_LAT = 1416;
							var START_LNG = 0;
							var STOP_LNG = 1020;							
							
							var SPLIT_LAT = 0;
							var SPLIT_LNG = 0;
									
							var MAP_X = 708;
							var MAP_Y = 510;
							function getResolution()
							{
								
							
								var pic_real_width = 0, pic_real_height = 0;
								pic_real_width = $("#map").width();
								pic_real_height = $("#map").height();
								
								
								
								SPLIT_LAT = parseFloat(MAP_X)/(parseFloat(STOP_LAT)- parseFloat(START_LAT));
								SPLIT_LNG = parseFloat(MAP_Y)/(parseFloat(STOP_LNG)- parseFloat(START_LNG));
								
								console.log("road map : W:"+pic_real_width+",H:"+pic_real_height);
								setRoadMap();
							}
						
							function rotateVehicle()
							{
								var name = "#image_canv_"+$("#id_car").val();
								var degree = $("#val_degree").val();
								var pic_real_width = 0, pic_real_height = 0;
								pic_real_width = $(name).width();
								pic_real_height = $(name).height();
								
								
								var vx = $("#val_x").val()-(pic_real_width/2);
								var vy = $("#val_y").val()-pic_real_height;
								console.log(vx);
								var rotate = 'rotate(' + degree + 'deg)';
								$(name).css({ 
									'-webkit-transform': rotate,
									'-moz-transform': rotate,
									'-o-transform': rotate,
									'-ms-transform': rotate,
									'transform': rotate 
								});
								$(name).parent().css({position: 'relative'});
								$(name).css({top: vy, left: vx, position:'absolute'});
					
								console.log(vx+","+vy);
								
								
								if($("#val_x").val() == $("#val_y").val())
								{
									$(name).attr("src", "bus2.png")
								}
								else
								{
									$(name).attr("src", "bus.png")
								}
							}
							
							var ROADMAP_X = 2195;
							var ROADMAP_Y = 2106;
							function setRoadMap()
							{
								var pic_real_width = 0, pic_real_height = 0;
								pic_real_width = $("#mymap").width();
								pic_real_height = $("#mymap").height();
								console.log("map : W:"+pic_real_width+",H:"+pic_real_height);
								//IMGX < RX  || IMGY < RY 
								var SCALE = 1;
								if(pic_real_height > ROADMAP_Y)
								{
									for(var i = 1.5; i <= 10; i = i + 0.1)
									{
										var new_size_x = (i*ROADMAP_X);
										var new_size_y = (i*ROADMAP_Y);
										console.log("scale [+"+i+"] road map : W:"+new_size_x+",H:"+new_size_y);
										if(new_size_y > pic_real_height )
										{
											new_size_x   = ((i - 0.1)*ROADMAP_X);
											new_size_y   = ((i - 0.1)*ROADMAP_Y);
											//SET IMAGEs
											$('#map').width(new_size_x);
											$('#map').height(new_size_y);
											break;
										}
									}
									
								}
								
								//IMGX > RX || IMGY > RY 
								else if(pic_real_height < ROADMAP_Y)
								{
									for(var i = 1.5; i <= 10; i = i + 0.1)
									{
										var new_size_x = ROADMAP_X-((ROADMAP_X*i)-ROADMAP_X);
										var new_size_y = ROADMAP_Y-((ROADMAP_Y*i)-ROADMAP_Y);
										console.log("scale [-"+i+"] road map : W:"+new_size_x+",H:"+new_size_y);
										if(new_size_y < pic_real_height )
										{
											SCALE = i - 0.5;
											 new_size_x = ROADMAP_X-((ROADMAP_X*(i ))-ROADMAP_X);
											 new_size_y = ROADMAP_Y-((ROADMAP_Y*(i))-ROADMAP_Y);		
											
											//SET IMAGEs
											$('#map').width(new_size_x);
											$('#map').height(new_size_y);
											break;
										}
									}
									
								}								
								
								
						
								
							}
							
							
							
							function rotateVehicleByValue()
							{
								
								//var degree = $("#val_degree").val();

								
								
								var ans = $.ajax(
								{
									url: "location.php", 
									type:"POST", 	
									async: false
								
								}).responseText;	
								var obj = jQuery.parseJSON( ans );
								
								var vehicle  		= obj.vehicle;					
								for(var i = 0; i < vehicle.length; i++)
								{
									var vehicleid = vehicle[i].id;
									var vehiclelat = (vehicle[i].lat-START_LAT)*SPLIT_LAT;
									var vehiclelng = (vehicle[i].lng-START_LNG)*SPLIT_LNG;
									var vehicleheading = vehicle[i].heading;
									var degree = vehicleheading;
									
									var name = "#image_canv_"+vehicleid;
									var pic_real_width = 0, pic_real_height = 0;
									pic_real_width = $(name).width();
									pic_real_height = $(name).height();
										var vx = vehiclelat-(pic_real_width/2);
										var vy = vehiclelng-pic_real_height;
										console.log(vehiclelng);
										var rotate = 'rotate(' + degree + 'deg)';
										$(name).css({ 
											'-webkit-transform': rotate,
											'-moz-transform': rotate,
											'-o-transform': rotate,
											'-ms-transform': rotate,
											'transform': rotate 
										});
										$(name).parent().css({position: 'relative'});
										$(name).css({top: vy, left: vx, position:'absolute'});
							
										console.log(vx+","+vy);
								
										
										if(checkCharger(vehiclelat , vehiclelng))
										{
											$(name).attr("src", "bus2.png")
										}
										else
										{
											$(name).attr("src", "bus.png")
										}
								}
							}
							
						
					
							function checkCharger(vehiclelat , vehiclelng)
							{
								if(vehiclelat >= 200 && vehiclelat <= 400)
								{
										if(vehiclelng >= 200 && vehiclelng <= 400)
										{
											return true;
										}
								}
								return false;
								
							}
							
							
							function initVehicle()
							{
								
								//var degree = $("#val_degree").val();
	
								
								
								var ans = $.ajax(
								{
									url: "init_vehicle.php", 
									type:"POST", 	
									async: false
								
								}).responseText;	
								var obj = jQuery.parseJSON( ans );
								
								var vehicle  		= obj.vehicle;					
								for(var i = 0; i < vehicle.length; i++)
								{
									var vehicleid = vehicle[i].id;
									var html_vehicle = "<img id=\"image_canv_"+vehicleid+"\" src=\"bus.png\" style=\"z-index: 10;  position: absolute; \" />";									
									$( "#mymap" ).append( html_vehicle);
								}
								
								autorun = true;
							}
							
							
				var auto_refresh_1 = setInterval(content_1s, 1000);	
				var auto_refresh_2 = setInterval(content_0s, 5000);
				var posx = 0;
				var autorun = false;
				function content_1s()
				{
					
					if(autorun)
					{
						rotateVehicleByValue();
					}
		
						//posx += 10;
				}
				function content_0s()
				{
					if(!autorun)
					{
						getResolution();
						initVehicle();
					}	
				
				}
					
	
