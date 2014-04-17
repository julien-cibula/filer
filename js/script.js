// add.listener
var drop_on=true;
function dropOnClick(idButton) {
		var id = "form_"+idButton;
		var elem = document.getElementById(id);
		if(elem.offsetHeight != 0){ // si l'offset est diff de 0, c'est que l'element est ouvert
			//On referme le paragraphe
			var height = 0; // on met la variable qui servira de param à 0 (targetheight de la fonction qui deroule, soit la taille qu'on souhait atteindre)
		}
		else{
		//On récupère la hauteur du paragraphe
		elem.style.display='block';
		elem.style.height = ''; // on vide la valeur
		var height = elem.offsetHeight; // after display block, offset = height with content
		elem.style.height = '0px'; // on efface l'element
		}
		accordionOnClick(id,2,height);
	}
	
	function accordionOnClick(id,px,targetHeight){
		var elem=document.getElementById(id);
		var height= parseInt(elem.style.height.replace(/px/, ''));
		var sens = (height < targetHeight ? 1 : -1); // on determine le sens du drop
		
		
		if(height != targetHeight){ // on verifie que la hauteur actuelle est diff de celle souhaité
			height= height+(sens*px); // on ajoute notre valeur à la hauteur
			elem.style.height= height+'px'; // on affiche notre "bout" de paragraphe
			setTimeout(function(){accordionOnClick(id,px,targetHeight)}, 15); // on boucle sur la fonction toutes les 20ms
		}
		else{
			drop_on=true;
		}
	}
	
	function showOverlay(id,idPop){
		var overlay = document.getElementById(id);
		var popup = document.getElementById(idPop);
		overlay.style.display="block";
		var height = window.innerHeight;
		var width = window.innerWidth;
		
		width=width-popup.offsetWidth;
		height=height-popup.offsetHeight;
		
		var miHeight = height/2;
		var miWidth = width/2;
		overlay.style.padding=miHeight+"px "+miWidth+"px";
	}
	
// -- (start) global var -- //
var overlayRegState="stop";
var overlayLogState="stop";
var overlayFileState="stop";
// -- (end) global var -- //

(function(){
	var buttons=document.getElementsByClassName("navButton");
	for(var i=0; i<buttons.length; i++){
		buttons[i].addEventListener("click", function(){
			if(drop_on){
				drop_on=false;
				var inputs=document.getElementsByClassName("hide_inputs");
				for(var i=0; i<inputs.length; i++){
					var id = inputs[i].id.replace(/form_/, '');
					var height = inputs[i].style.height.replace(/px/, '');
					if(height != 0 && id != this.id){
						dropOnClick(id);
					}
				}
				dropOnClick(this.id);
			}
		},false);
	}
	
	// -- (start) tabulation pour tree dir --//
	var treeElem = document.getElementsByClassName('treeElem');
	for(var i=0; i<treeElem.length; i++){
		var parent=treeElem[i].parentNode;
		var lvl = treeElem[i].getAttribute('data-lvl');
		var tabulation = 50+(lvl*20);
		treeElem[i].style.paddingLeft=tabulation+"px";
		treeElem[i].style.backgroundImage="url('./images/icons/16px/dir.png'), url('./images/dir-close.png')";
		treeElem[i].style.backgroundRepeat="no-repeat";
		treeElem[i].style.backgroundPosition=(tabulation-20)+"px 50%,"+(tabulation-40)+"px, 50%";
		
		
		/* if(lvl > 1){
			parent.style.display="none";
		} */
	}
	// -- (end) tabulation pour tree dir --//
	
	var elem=document.getElementsByClassName("rename");
	for(var i=0; i<elem.length; i++){
		elem[i].addEventListener("click", function(){
			var form=this.parentNode.parentNode.firstChild.nextSibling.firstChild;
			form.style.display="inline";
			form.nextSibling.style.display="none";
			var input=form.firstChild;
			input.addEventListener("blur", function(){
				this.parentNode.submit();
			},false);
		},false);
	}
	var elem=document.getElementsByClassName("delete");
	for(var i=0; i<elem.length; i++){
		elem[i].addEventListener("click", function(){
			if(confirm('Etes vous sûre ?')){document.location.href=this.href;}
		},false);
	}
	
	/* var rewrite = document.getElementsByClassName('rewrite');
	for(var i=0; i< rewrite.length; i++){
		rewrite[i].addEventListener("click", function(){
			overlayFileState="rdy";
			showOverlay('overlay_file','filebox');
		},false);
	} */
	
	window.addEventListener("resize", function (){
		if(overlayRegState == "rdy"){
			showOverlay('overlay_register','registerbox');
		}
	},false);
	
	window.addEventListener("resize", function (){
		if(overlayLogState == "rdy"){
			showOverlay('overlay_login','loginbox');
		}
	},false);
	
	window.addEventListener("resize", function (){
		if(overlayFileState == "rdy"){
			showOverlay('overlay_file','filebox');
		}
	},false);
	
	if(document.getElementsByClassName('rewrite')[0]){
		showOverlay('overlay_file','filebox');
		overlayFileState="rdy";
	}
	
	if(document.getElementsByClassName('error_register')[0]){
		showOverlay('overlay_register','registerbox');
		overlayRegState="rdy";
	}
	if(document.getElementsByClassName('error_login')[0]){
		showOverlay('overlay_login','loginbox');
		overlayLogState="rdy";
	}
	
	/* if(document.getElementById("filebox-close")){
		var fileClose = document.getElementById("filebox-close")
		fileClose.addEventListener("click", function(){
			var overlay = document.getElementById('overlay_file');
			overlay.style.display="none";
			overlayFileState="stop";
		},false);
	} */
	
	var formButtonUser=document.getElementsByClassName('user_button');
	for(var i=0; i<formButtonUser.length; i++){
		formButtonUser[i].addEventListener("click", function(){
			var form = this.parentNode;
			var tag = form.tagName;
			while(tag != "FORM"){
				var form= form.parentNode;
				tag = form.tagName;
			}
			form.submit();
		},false);
	}
	
	if(document.getElementById('button-rewrite')){
		var rewriteButton = document.getElementById('button-rewrite');
		rewriteButton.addEventListener("click", function(){
			var pre = document.getElementById('area_wrap').firstChild;
			while(pre.nodeType != 1){
				pre = pre.nextSibling;
			}
			var preContent = pre.innerHTML;
			var area=document.getElementById('rewrite-area');
			area.innerHTML=preContent;
			console.log(area.innerHTML);
			area.parentNode.submit();
		},false);
	}
	
	if(document.getElementById('nav_register')){
		var button_reg=document.getElementById('nav_register');
		button_reg.addEventListener("click", function(){
			overlayRegState="rdy";
			showOverlay('overlay_register','registerbox');
		},false);
	}
	
	if(document.getElementById('nav_login')){
		var button_log=document.getElementById('nav_login');
		button_log.addEventListener("click", function(){
			overlayLogState="rdy";
			showOverlay('overlay_login','loginbox');
		},false);
	}
	
	if(document.getElementById("registerbox-close")){
		var registerClose = document.getElementById("registerbox-close");
		registerClose.addEventListener("click", function(){
			var overlay = document.getElementById('overlay_register');
			overlay.style.display="none";
			overlayRegState="stop";
		},false);
	}
	
	if(document.getElementById("loginbox-close")){
		var loginClose = document.getElementById("loginbox-close");
		loginClose.addEventListener("click", function(){
			var overlay = document.getElementById('overlay_login');
			overlay.style.display="none";
			overlayLogState="stop";
		},false);
	}
	
})();
