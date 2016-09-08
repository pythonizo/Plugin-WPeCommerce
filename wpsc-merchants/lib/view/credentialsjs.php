<!-- TAB STATUS-->
<script type="text/javascript">
   	function credentials(mode){
   		if (mode == 'test'){
       		mail = document.getElementById("mail_dev").value;
       		pass = document.getElementById("pass_dev").value;
   		}else{
   			mail = document.getElementById("mail_prod").value;
       		pass = document.getElementById("pass_prod").value;
   		}

   		if (mail == null || mail ==''){  alert('El mail esta vacio'); return 0;     }
   		if (pass == null || pass ==''){  alert('El password esta vacio'); return 0; }

   		var xhttp = new XMLHttpRequest();				

   		xhttp.open("POST", "../wp-content/plugins/wp-e-commerce/wpsc-merchants/lib/view/credentials.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		xhttp.send("mail="+mail+"&pass="+pass+"&mode="+mode);
		
		xhttp.onreadystatechange = function() {
			console.log(mode);
			console.log(xhttp.responseText);
	
			//var json = xhttp.responseText ;
			var str = xhttp.responseText;
			var str = JSON.stringify(str);
		
		//	if (xhttp.readyState == 4 && xhttp.status == 200) {
		    str = str.replace(/[.*+"!?^${}()|[\]\\]/g, "");
		    str = Java_to_Latin1(str);

		    resultMessage = str.split(":");
		    console.log(resultMessage);
		 
		    if (resultMessage && resultMessage !='' && resultMessage[0]=='mensajeResultado'){
		    	alert(resultMessage);
		    	return 0;
		    }

		    var res = str.split(",");

		    var codigoResultado = res[0].split(":");
		    var merchantid = res[1].split(":");
		    var apikey = res[2].split(":");
		    var security = res[3].split(":"); 
		    				    
		    console.log(codigoResultado);
		    console.log(merchantid);
			console.log(apikey);

			//return ;

			if(mode=='test'){
			    document.getElementById("todopago_merchant_id_dev").value = merchantid[1];
			    document.getElementById("todopago_authorization_header_dev").value = apikey[1];	
			    document.getElementById("todopago_security_dev").value = security[1];						
			}else{
				document.getElementById("todopago_merchant_id_prod").value = merchantid[1];
			    document.getElementById("todopago_authorization_header_prod").value = apikey[1];	
			    document.getElementById("todopago_security_prod").value = security[1];

			}

		};	

    }

    function Java_to_Latin1(str)
    {
		str= str.replace(/u00a0/g, ""); 
		str= str.replace(/u00a1/g, "¡");
		str= str.replace(/u00a2/g, "¢");
		str= str.replace(/u00a3/g, "£");
		str= str.replace(/u00a4/g, "¤");
		str= str.replace(/u00a5/g, "¥");
		str= str.replace(/u00a6/g, "¦");
		str= str.replace(/u00a7/g, "§");
		str= str.replace(/u00a8/g, "¨");
		str= str.replace(/u00a9/g, "©");
		str= str.replace(/u00aa/g, "ª");
		str= str.replace(/u00ab/g, "«");
		str= str.replace(/u00ac/g, " ");
		str= str.replace(/u00ad/g, "­"); 
		str= str.replace(/u00ae/g, "®");
		str= str.replace(/u00af/g, "¯");
		str= str.replace(/u00b0/g, "°");
		str= str.replace(/u00b1/g, "±");
		str= str.replace(/u00b2/g, "²");
		str= str.replace(/u00b3/g, "³");
		str= str.replace(/u00b4/g, "´");
		str= str.replace(/u00b5/g, "µ");
		str= str.replace(/u00b6/g, " ");
		str= str.replace(/u00b7/g, "·");
		str= str.replace(/u00b8/g, "¸");
		str= str.replace(/u00b9/g, "¹");
		str= str.replace(/u00ba/g, "º");
		str= str.replace(/u00bb/g, "»");
		str= str.replace(/u00bc/g, "¼");
		str= str.replace(/u00bd/g, "½");
		str= str.replace(/u00be/g, "¾");
		str= str.replace(/u00bf/g, "¿");
		str= str.replace(/u00c0/g, "À");
		str= str.replace(/u00c1/g, "Á");
		str= str.replace(/u00c2/g, "Â");
		str= str.replace(/u00c3/g, "Ã");
		str= str.replace(/u00c4/g, "Ä");
		str= str.replace(/u00c5/g, "Å");
		str= str.replace(/u00c6/g, "Æ");
		str= str.replace(/u00c7/g, "Ç");
		str= str.replace(/u00c8/g, "È");
		str= str.replace(/u00c9/g, "É");
		str= str.replace(/u00ca/g, "Ê");
		str= str.replace(/u00cb/g, "Ë");
		str= str.replace(/u00cc/g, "Ì");
		str= str.replace(/u00cd/g, "Í");
		str= str.replace(/u00ce/g, "Î");
		str= str.replace(/u00cf/g, "Ï");
		str= str.replace(/u00d0/g, "Ð");
		str= str.replace(/u00d1/g, "Ñ");
		str= str.replace(/u00d2/g, "Ò");
		str= str.replace(/u00d3/g, "Ó");
		str= str.replace(/u00d4/g, "Ô");
		str= str.replace(/u00d5/g, "Õ");
		str= str.replace(/u00d6/g, "Ö");
		str= str.replace(/u00d7/g, "×");
		str= str.replace(/u00d8/g, "Ø");
		str= str.replace(/u00d9/g, "Ù");
		str= str.replace(/u00da/g, "Ú");
		str= str.replace(/u00db/g, "Û");
		str= str.replace(/u00dc/g, "Ü");
		str= str.replace(/u00dd/g, "Ý");
		str= str.replace(/u00de/g, "Þ");
		str= str.replace(/u00df/g, "ß");
		str= str.replace(/u00e0/g, "à");
		str= str.replace(/u00e1/g, "á");
		str= str.replace(/u00e2/g, "â");
		str= str.replace(/u00e3/g, "ã");
		str= str.replace(/u00e4/g, "ä");
		str= str.replace(/u00e5/g, "å");
		str= str.replace(/u00e6/g, "æ");
		str= str.replace(/u00e7/g, "ç");
		str= str.replace(/u00e8/g, "è");
		str= str.replace(/u00e9/g, "é");
		str= str.replace(/u00ea/g, "ê");
		str= str.replace(/u00eb/g, "ë");
		str= str.replace(/u00ec/g, "ì");
		str= str.replace(/u00ed/g, "í");
		str= str.replace(/u00ee/g, "î");
		str= str.replace(/u00ef/g, "ï");
		str= str.replace(/u00f0/g, "ð");
		str= str.replace(/u00f1/g, "ñ");
		str= str.replace(/u00f2/g, "ò");
		str= str.replace(/u00f3/g, "ó");
		str= str.replace(/u00f4/g, "ô");
		str= str.replace(/u00f5/g, "õ");
		str= str.replace(/u00f6/g, "ö");
		str= str.replace(/u00f7/g, "÷");
		str= str.replace(/u00f8/g, "ø");
		str= str.replace(/u00f9/g, "ù");
		str= str.replace(/u00fa/g, "ú");
		str= str.replace(/u00fb/g, "û");
		str= str.replace(/u00fc/g, "ü");
		str= str.replace(/u00fd/g, "ý");
		str= str.replace(/u00fe/g, "þ");
		str= str.replace(/u00ff/g, "ÿ");

		return str;
    }


</script>
