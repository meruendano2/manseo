// JavaScript Document

<!--
	function MostrarAyuda(texto){
	
		ayuda.value=texto;
		window.status=texto;
		ayuda.style.visibility="visible";
	}
	function OcultarAyuda(){
	window.status="Gestión inmobiliaria";
	ayuda.style.visibility="hidden";
	}
	
	function areaDisponible() {

		var winW = null;
		var winH = null;

		if (typeof window.innerWidth != 'undefined') {
			winW = window.innerWidth;
			winH = window.innerHeight;
		} else if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0) {
			winW = document.documentElement.clientWidth;
			winH = document.documentElement.clientHeight;
		} else {
			winW = document.getElementsByTagName('body')[0].clientWidth;
			winH = document.getElementsByTagName('body')[0].clientHeight;
		}
		return {ancho: winW, alto: winH};
	}
	
	function fullScreenWin(url) {
		var w = screen.width-10;
		var h = screen.height-90;
		var params = "top=0,left=2,width="+w+",height="+h+",dependent=yes,scrollbars=yes";
		var win = open(url,"win",params);
	}
	
	function extraerDeURL(param) {
		var params = location.search.substr(1,location.search.length).split("=");
		var pos = posEnArray(params, param);
		return (pos!=-1)? params[++pos] : null;
	}
	
	function posEnArray(array, valor) {
		var val = -1;
		for(var i=0; i<array.length; i++) {
			if(array[i]==valor) val = i;
		}
		return val;
	}
	
	function cargarImagen(url, img) {
	
		var auxImg = new Image();
		auxImg.src = url;
		auxImg.onload = function() {
			img.onload = null;
			img.src = auxImg.src;
			img.width = auxImg.width;
			img.height = auxImg.height;
			centrarEnVentana(img);
		}
		delete auxImg;
	}
	
	function centrarEnVentana(img) {
		img.style.marginTop = -(img.height/2)+"px";
		img.style.marginLeft = -(img.width/2)+"px";
	}
	
	
	

	function MostrarAyuda(texto){
	
		ayuda.value=texto;
		window.status=texto;
		ayuda.style.visibility="visible";
	}
	function OcultarAyuda(){
	window.status="Gestión inmobiliaria";
	ayuda.style.visibility="hidden";
	}

	
	
	
	
	
	
	
//-->
