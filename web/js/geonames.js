baseURL = "http://api.geonames.org";

//lo unico necesario es el la url del proxy desde donde se encuentre y el selectName que es el id del Select de paises. 
//Lo demas es para poder traer el state y el city correspondiente cuando existen
function loadCountries(proxy,selectName,id,selectNameSt,idState,idCity,selectNameCity)
{
    url = baseURL + '/countryInfo?username=drued13&lang=EN&continent=NA&type=JSON&style=SHORT';
    //Llenar combo de países
    $.getJSON(proxy,{url:url}, function(data){
        data.contents.geonames.sort(function(a,b){
            return a.countryName.toLowerCase().localeCompare(b.countryName.toLowerCase());
        });
        
        $.each(data.contents.geonames, function(i, item){
            if(item.geonameId == id){
                $('#' + selectName).append($('<option selected="selected">').val(item.geonameId).attr('countryCode', item.countryCode).html(item.countryName));
                $('#Slot_city').empty();
                $('#Slot_city').append(	$('<option>').val('').html('Select').attr('selected', 'selected')	);
                loadStates(proxy,item.countryCode,selectNameSt,idState,selectNameCity,idCity);
            }else{
                $('#' + selectName).append($('<option>').val(item.geonameId).attr('countryCode', item.countryCode).html(item.countryName));
            }
        });
        
    });
    
}

function loadStates(proxy,countryCode, selectName,id,selectNameC,idCity)
{
    url = baseURL + '/searchJSON?lang=EN&username=drued13&country=' + countryCode + '&featureCode=ADM1';
    
    $.getJSON(proxy,{url: url},  function(data){
        $('#'+ selectName).empty();
        $('#' + selectName).append($('<option>').val('').html('Select').attr('selected', 'selected')	);
        $('#'+ selectNameC).empty();
        $('#' + selectNameC).append(	$('<option>').val('').html('Select').attr('selected', 'selected')	);
		
        data.contents.geonames.sort(function(a,b){
            return a.name.toLowerCase().localeCompare(b.name.toLowerCase());
        });
        
        
        $.each(data.contents.geonames, function(i, item){
            if(item.geonameId == id){
                $('#' + selectName).append($('<option selected="selected">').val(item.geonameId).attr('adminCode1', item.adminCode1 ).html(item.name));
                loadCities(proxy,countryCode,item.adminCode1,selectNameC,idCity);
            }else{
                $('#' + selectName).append($('<option>').val(item.geonameId).attr('adminCode1', item.adminCode1 ).html(item.name));
            }
            
        });
    });
    
}

function loadCities(proxy,countryCode,adminCode1, selectName,id)
{
    url = baseURL + '/searchJSON?username=drued13&lang=EN&country=' + countryCode + '&adminCode1=' + adminCode1 + '&featureClass=P';
    
    $.getJSON(proxy, { url: url }, function(data){
        $('#'+ selectName).empty();
            $('#' + selectName).append(	$('<option>').val('').html('Select').attr('selected', 'selected')	);
        data.contents.geonames.sort(function(a,b){
            return a.name.toLowerCase().localeCompare(b.name.toLowerCase());
        });

        $.each(data.contents.geonames, function(i, item){
            if(item.geonameId == id){
                $('#' + selectName).append($('<option selected="selected">').val(item.geonameId).html(item.name));
            }else{
                $('#' + selectName).append($('<option>').val(item.geonameId).html(item.name));
            }
           
        });
    });
}

// ingresa en el campo con id name la direccion segun un country_geoname_id, un Adm1_geoname_id y un city_geoname_id en el orden [city],[state],[country]
function getAdrress(proxy,country,state,city,name){
	var countryCode;
	urlCountry = 'http://api.geonames.org/getJSON?username=drued13&lang=EN&geonameId='+country;
	$.getJSON(proxy, { url: urlCountry }, function(data){
		$("#"+name).append(data.contents.countryName);
		countryCode =data.contents.countryCode;
		urlState = "http://api.geonames.org/searchJSON?lang=EN&username=drued13&country=" + countryCode + "&featureCode=ADM1";
		$.getJSON(proxy,{url: urlState},  function(data){
			
			$.each(data.contents.geonames, function(i, item){
				if(item.geonameId == state){
					$("#"+name).prepend(item.name + ",");
					
					urlCity = 'http://api.geonames.org/searchJSON?username=drued13&lang=EN&country=' + countryCode + '&adminCode1=' + item.adminCode1 + '&featureClass=P';
					$.getJSON(proxy,{url: urlCity},  function(data){
						
						$.each(data.contents.geonames, function(i, item){
							if(item.geonameId == city){
								$("#"+name).prepend(item.name +  ",");
							}
						});
					});
					
				}
				
			});
		});
    });
}




function loader(ElementId){
    $("#"+ElementId).hide();
    
    $("#"+ElementId).hide();
    $(".Slot_submit").attr('disabled',false);
    $("#Slot_cancel").attr('disabled',false);
}


